<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\HttpStatus;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @var LoginProxy
     */
    private $loginProxy;

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $loginAttempt = $this->loginProxy->attemptLogin($request->get('email'), $request->password);
        if ($loginAttempt) {
            return response()->json($loginAttempt, HttpStatus::SUCCESS);
        }
        return response()->json(['error' => 'Unauthorised'], HttpStatus::UNAUTHORIZED);
    }

    public function refresh(Request $request)
    {
        $refreshAttempt = $this->loginProxy->attemptRefresh();
        if($refreshAttempt){
            return response()->json($refreshAttempt, HttpStatus::SUCCESS);
        }
        return response()->json(['error' => 'Unauthorised'], HttpStatus::UNAUTHORIZED);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check()
    {
        $user = Auth::user();
        $data['data'] = new UserResource($user);
        return response()->json($data, HttpStatus::SUCCESS);
    }
}
