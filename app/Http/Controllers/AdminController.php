<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

	public function index()
	{
		if (!Auth::check())
        {
            return Redirect::to('/auth/login')->with('message', 'Action requires login');
        }
		return view('admin.dashboard');
    }
}
