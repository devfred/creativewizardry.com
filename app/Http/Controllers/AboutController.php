<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\ContactFormRequest;

class AboutController extends Controller {

	public function create()
    {
        return view('about.contact');
    }

    public function info()
    {
        return view('about.info');
    }

    public function store(ContactFormRequest $request)
    {
    	
    	\Mail::send(
    		'emails.contact',
    		array(
    			'name' => $request->get('name'),
    			'email' => $request->get('email'),
    			'user_message' => $request->get('message') ), 
        	function($message)
	    	{
	        	$message->from('devfred@creativewizardry.com');
	        	$message->to('mcdevfred@gmail.com', 'Admin')->subject('Creative Wizardry Contact Form');
	    	}
	    );

    	return \Redirect::route('contact')
    		->with('message', 'Thanks for reaching out.' );
    }

}
