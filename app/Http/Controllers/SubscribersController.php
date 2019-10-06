<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
	public function store()
    {
    	$data = request()->validate([
          'email' => 'required|email|unique:subscribers,email'
    	]);

    	$subscriber = new Subscriber();
    	$subscriber->email = request('email');
    	$subscriber->save();

        return back(); // return redirect()->route('task.index');
    }

    public function index()
    {
    	$subscribers = Subscriber::all();

    	return view('subscribers', compact('subscribers'));
    }
}
