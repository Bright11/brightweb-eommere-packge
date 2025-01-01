<?php
namespace Brightweb\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        // Check if the user is authenticated and has the 'admin' role
        if ($user && $user->role == 'admin') {
            return $next($request);  // Allow the request to proceed if the user is an admin
        }
        
        // If user is not authenticated or not an admin, redirect to the home page or a specific route
        return redirect()->route('index');
        
        // Alternatively, if you want to send a 403 response instead of redirecting:
        // return response()->json(['message' => 'Forbidden'], Response::HTTP_FORBIDDEN);
    }
}
