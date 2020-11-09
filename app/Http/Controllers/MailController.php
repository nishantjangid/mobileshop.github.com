<?php

namespace App\Http\Controllers;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    function SendEmail(Request $req)
    {
        // return "post by the contact form";
        $details = [
            'title' => $req->email,
             'body' => $req->message,
        ];
        // return $details;

        // Mail::to("Recipent email id")
        // \Mail::to("nishantjangid000@gmail.com")->send(new TestMail($details));
        $req->session()->flash('alertSuccess');
        alert()->success('Mail Send Successfully')->persistent('Close')->autoClose(3000);
        return view('contact_us');

    }
}
