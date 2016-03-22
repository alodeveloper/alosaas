<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccountVerifyMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      /// TODO: check the account subdomain is related to logged in users data or not.
      
      return $next($request);
    }

}
