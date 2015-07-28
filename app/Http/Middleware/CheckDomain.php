<?php namespace App\Http\Middleware;

use Closure;

class CheckDomain {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		
		if( $request->server->get('HTTP_HOST') != getenv('SITE_URL') )
		{
			\Redirect::to( getenv('SITE_URL') );
		}
		dd($request);
		return $next($request);
	}

}
