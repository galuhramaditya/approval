<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\UserService;
use App\Libraries\Response;
use App\Libraries\Token;

class AuthToken
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handle($request, Closure $next)
    {
        try {
            $data = Token::decode($request->token);
            $user = $this->userService->findOneBy((array) $data);

            if ($user) {
                $user->conm = $user->company->CompAlias;
                unset($user->company);

                $request->merge(["token" => $user]);
                return $next($request);
            }

            return Response::error("must include token", ["token" => "token is not valid"]);
        } catch (\Throwable $e) { }
        return Response::error("must include token", ["token" => "token required"]);
    }
}