<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Product';
        $product = Product::allowed(auth()->user());

        if($request->input('name')){
            $product = $product->where('name' , 'like', '%'.$request->input('name').'%');
        }
        if($request->input('sku')){
            $product = $product->where('sku' , 'like', '%'.$request->input('sku').'%');
        }

        $data['products'] = $product->paginate(10);
        
        return view('products.index', $data);
    }
    
    public function create()
    {
        if (! Gate::allows('create-product')) {
            abort(403);
        }
        $data['title'] = 'Create Product';
        
        return view('products.create', $data);
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create-product')) {
            abort(403);
        }
        $this->validate($request, [
            'name' => 'required',
            'sku' => 'required|unique:App\Models\Product,sku',
            'description' => 'required',
            // 'image' => 'required|image',
        ]);

        // upload image to storage
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $file_name = $request->input('sku'). Helper::generateRandomString();
        
        // check if uniq name valid
        $check_img_file = Product::where([['image_uniq', $file_name]])->first();
        while ($check_img_file){
            $file_name = $request->input('sku'). Helper::generateRandomString(); 
            $check_img_file = Product::where([['image_uniq', $file_name]])->first();
        };
        $path = Storage::disk('local')->putFileAs('/public/product', $image, $file_name.'.'.$extension, 'public');

        //store product
        $product = new Product;
        $product->image_path = $path;
        $product->image_uniq = $file_name;
        $product->name = $request->input('name');
        $product->sku = $request->input('sku');
        $product->created_by = auth()->user()->id;
        $product->status = 1;
        $product->description = $request->input('description');

        if($product->save()){
            return redirect(route('products'))->with('success', 'Successfully add new product');
        }
        return redirect()->back()->with('error', 'Failed to add new product');
    }

    public function show($product)
    {
        $product = Product::where('sku', $product)->first();
        if(!$product){
            abort(404);
        }
        if (! Gate::allows('update-product', $product)) {
            abort(403);
        }
        $data['title'] = 'Product - ' . $product->name;
        $data['product'] = $product;
        
        return view('products.show', $data);
    }

    public function update(Request $request,  $product)
    {
        $product = Product::where('sku', $product)->first();
        if(!$product){
            abort(404);
        }
        if (! Gate::allows('update-product', $product)) {
            abort(403);
        }
        
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        if($request->input('sku') != $product->sku){
            $this->validate($request, [
                'sku' => 'required|unique:App\Models\Product,sku',
            ]);
        }

        // check if image is updated
        if( $request->file('image') ){
            // upload image to storage
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $file_name = $request->input('sku'). Helper::generateRandomString();
            
            // check if uniq name valid
            $check_img_file = Product::where([['image_uniq', $file_name]])->first();
            while ($check_img_file){
                $file_name = $request->input('sku'). Helper::generateRandomString(); 
                $check_img_file = Product::where([['image_uniq', $file_name]])->first();
            };
            $path = Storage::disk('local')->putFileAs('/public/product', $image, $file_name.'.'.$extension, 'public');
            $product->image_path = $path;
            $product->image_uniq = $file_name;
        }

        //store product
        $product->name = $request->input('name');
        $product->sku = $request->input('sku');
        $product->description = $request->input('description');

        if($product->save()){
            return redirect(route('products'))->with('success', 'Successfully add new product');
        }
        return redirect()->back()->with('error', 'Failed to add new product');
    }

    public function delete($product)
    {
        $product = Product::where('sku', $product)->first();
        if(!$product){
            abort(404);
        }
        
        if (! Gate::allows('delete-product', $product)) {
            abort(403);
        }
        if($product->delete()){
            return redirect( route('products') )->with('success', 'Successfully delete product with sku : ' . $product->sku);
        }
    }
}
