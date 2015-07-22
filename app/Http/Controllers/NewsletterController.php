<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\NewsletterFormRequest;

class NewsletterController extends Controller {

    /**
     * @param NewsletterFormRequest $request
     * @return mixed
     */
	public function signup(NewsletterFormRequest $request)
    {
        $API_KEY = env('MAILCHIMP_KEY');
        $LIST_ID = env('MAILCHIMP_LIST_ID');
        $mc = new \Mailchimp( $API_KEY );
        $name = $request->get('name');
        $email = $request->get('email');
        $mc->lists->subscribe($LIST_ID, array('name'=>$name,'email'=>$email ) );
        return \Redirect::to('/')->with('message', 'Thanks for subscribing ' . ucfirst($name) .'.' );
    }

}
