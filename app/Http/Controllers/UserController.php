<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('user-view')) {
            abort(403);
        }
        $users = User::query();
        if($request->input('name')){
            $users = $users->where('name' , 'like', '%'.$request->input('name').'%');
        }
        
        if($request->input('email')){
            $users = $users->where('email' , 'like', '%'.$request->input('email').'%');
        }
        $data['title'] = 'User';
        $data['users'] = $users->paginate(10);
        
        return view('user.index', $data);
    }

}
