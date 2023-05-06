<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Mail\SendInvitationMail;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('view-invite')) {
            abort(403);
        }
        $invitations = Invitation::query();
        if($request->input('name')){
            $invitations = $invitations->where('name' , 'like', '%'.$request->input('name').'%');
        }
        
        if($request->input('email')){
            $invitations = $invitations->where('email' , 'like', '%'.$request->input('email').'%');
        }
        $data['title'] = 'Invitation';
        $data['invitations'] = $invitations->paginate(10);
        
        return view('invitation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('view-invite')) {
            abort(403);
        }
        $data['title'] = 'Create Invitation';
        
        return view('invitation.create', $data);
    }

    public function store(Request $request)
    {
        if (!Gate::allows('create-invite')) {
            abort(403);
        }
        $validation = [
            'name' => 'required',
            'email' => 'required|email',
        ];
        if(auth()->user()->role == 'admin'){
            $validation['role'] = 'required|in:admin,manager';
        }else if(auth()->user()->role == 'manager'){
            $validation['role'] = 'required|in:manager';
        }
        $this->validate($request, $validation);

        //Unique Token
        $token = Helper::generateRandomString(20);
        $check_token_exists = Invitation::where('token', $token)->first();
        while($check_token_exists){
            $token = Helper::generateRandomString(20);
            $check_token_exists = Invitation::where('token', $token)->first();
        }

        $invitation = new Invitation;
        $invitation->name = $request->input('name');
        $invitation->email = $request->input('email');
        $invitation->role = $request->input('role');
        $invitation->token = $token;
        $invitation->created_by = auth()->user()->id;
        $invitation->status = 1;

        if($invitation->save()){
            Mail::to($request->input('email'))->send(new SendInvitationMail($invitation));
            return redirect(route('invitations'))->with('success', 'Successfully add new invitation');
        }
        return redirect()->back()->with('error', 'Failed to add new invitation');
    }

    public function show($token)
    {
        if (!Gate::allows('view-invite')) {
            abort(403);
        }
        $invitation = Invitation::where('token', $token)->first();
        if(!$invitation){
            abort(404);
        }
        $data['title'] = 'Invitation';
        $data['invitation'] = $invitation;
          
        return view('invitation.show', $data);
    }

}
