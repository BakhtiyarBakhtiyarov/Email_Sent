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

    public function send()
    {
        $users = Users::first();
        $email = $users->email;
        Mail::to( $email )->send(new Contact());
        return redirect()->route('user.index')->with('success','Mail Sent!!!');
    }

}
