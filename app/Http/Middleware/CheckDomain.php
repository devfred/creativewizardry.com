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
			header('Location: http://'. getenv('SITE_URL'), true, 301);
		}		
		return $next($request);
	}

}
