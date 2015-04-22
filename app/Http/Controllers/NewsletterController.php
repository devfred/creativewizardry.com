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
        $API_KEY = '5ddc0254935fd11a2479477bbb2162f1-us10';
        $LIST_ID = '5b8220a723';
        $mc = new \Mailchimp( $API_KEY );
        $name = $request->get('name');
        $email = $request->get('email');
        $mc->lists->subscribe($LIST_ID, array('name'=>$name,'email'=>$email ) );
        return \Redirect::to('/')->with('message', 'Thanks for subscribing ' . ucfirst($name) .'.' );
    }

}
