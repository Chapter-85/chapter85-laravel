<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($request->all());

        Mail::to('chapter85.pk@hotmail.com')->send(new ContactFormMail($contact));

        return back()->with('success', 'Your message has been sent successfully.');
    }
}
