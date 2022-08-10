<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return view('users',compact('users'));
    }

    public function send(Request $request)
    {
        Mail::to( $request->email )->send(new Contact());
        return "ok";
    }

    
}
