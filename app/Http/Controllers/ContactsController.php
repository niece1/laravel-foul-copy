<?php

namespace App\Http\Controllers;

//use App\Subscriber;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
	public function create()
	{

		return view('contacts.create');
	}

	public function store()
	{
		$data = request()->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required',
		]);

		Mail::to('test@test.com')->send(new ContactFormMail($data));

		return redirect('contacts')->with('message', 'Thanks for your message. We\'ll be in touch.');
	}
}
