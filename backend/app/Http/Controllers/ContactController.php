<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'email'=> 'required|string|email',
            'comment' => 'required|string'
        ]);

        if($validated){
            Mail::to('manuelferro201@gmail.com')->send(new ContactFormMail( $validated ));
            return response()->json(['message' => 'Email inviata!']);
        }
        else{
            return response()->json(['message'=> 'message not send']);
        }
    }
}
