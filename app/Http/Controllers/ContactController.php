<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact_us.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required',
            'subject' => 'required|min:3',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'subject' => $validatedData['subject'],
            'text' => $validatedData['message'],
        ]);

        return redirect()->back()->with('success', 'پیام شما با موفقیت ارسال شد');
    }
}
