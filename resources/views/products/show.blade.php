@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row ">
                                <div class="col-sm-4 ">
                                    <img id="display_image" class="img-fluid" src="{{ Storage::url($product->image_path) }}" alt="Product Image ({{ $product->name }})">    
                                </div>
                                <div class="col-sm-8">

                                    @can('restore-product', $product)
                                    <form action="{{ route('products-update',$product->sku )}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        
                                    @endcan
                                        <div class="mb-3 row">
                                            <div class="col-sm-3">
                                                <label for="name">Name <span style="color: red">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}" required @cannot('restore-product', $product) disabled @endcannot>  
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-3">
                                                <label for="sku">SKU <span style="color: red">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="sku" id="sku" value="{{ $product->sku }}" required  @cannot('restore-product', $product) disabled @endcannot>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-3">
                                                <label for="description">Description <span style="color: red">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" required @cannot('restore-product', $product) disabled @endcannot>{{ $product->description }}</textarea>
                                            </div>
                                        </div>
                                        @if(Auth::user()->role == 'admin')
                                        <div class="mb-3 row">
                                            <div class="col-sm-3">
                                                <label for="created_by">Manager Name</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <span class="badge bg-primary">{{$product->owner->name}}</span>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="mb-3 row">
                                            <div class="col-sm-3">
                                                <label for="name">Image</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="image" type="file" accept="image/*" name="image"  @cannot('restore-product', $product) disabled @endcannot>
                                            </div>
                                        </div>
                                    @can('restore-product', $product)
                                        <div class="mb-3 row">
                                            <div class="col-sm-12 text-center">
                                                <button type="submit" id="submit_button" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
