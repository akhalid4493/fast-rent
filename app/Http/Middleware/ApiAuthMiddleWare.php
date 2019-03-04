<?php

namespace App\Http\Middleware;

use Closure;
use App\TheApp\Repository\Api\Users\UserRepository;

class ApiAuthMiddleWare
{
    function __construct(UserRepository $user)
    {
        $this->userModel = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userLogin = $this->userModel->checkLogin($request);

        if($userLogin == true) {

            return $next($request);
        
        } else {
        
            return response()->json([
                'data'          => [],
                'successfully'  => false,
                'errors'        => ['unauthenticated'],
            ],401);
        
        }
    }
}
