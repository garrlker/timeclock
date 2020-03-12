<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class LoginAsGuest
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    // The default user created when you seed the app
    $userId = 1;
    
    // Log the user in as our single "guest" user
    if (!Auth::id()) {
      Auth::loginUsingId($userId);
    }

    return $next($request);
  }
}
