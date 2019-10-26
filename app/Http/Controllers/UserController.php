<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Libraries\Validation;
use App\Libraries\Response;
use App\Libraries\Token;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService      = $userService;
    }

    public function login(Request $request)
    {
        Validation::rules([
            "cocd"      => "required",
            "usercd"    => "required",
            "password"  => "required",
        ])->validate($request);

        $user = $this->userService->findOneBy($request->only(["cocd", "usercd", "password"]));

        if ($user) {
            $token = Token::encode($user);
            return Response::success("login successfully", ["token" => $token]);
        }
        return Response::error("user does not exist", $user);
    }

    public function current(Request $request)
    {
        return Response::success("successfully getting current user data", $request->token);
    }
}
