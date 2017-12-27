<?php

namespace App\Api\V1\Controllers;

use Config;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Services\Wallet\WalletBase;
use App\Api\V1\Requests\SignUpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SignUpController extends Controller
{	
   /**
    * @SWG\Post(
    *    tags={"Common"},
    *    path="/auth/signup",
    *    description="Registers a user, manufacturer and a technician",
    *    @SWG\Parameter(
    *       name="name",
    *       in="query",
    *       type="string",
    *       required=true,
    *       description="Full Name of the user"
    *    ),
    *    @SWG\Parameter(
    *       name="email",
    *       in="query",
    *       type="string",
    *       required=true,
    *       description="Email Id of the user"
    *    ),
    *    @SWG\Parameter(
    *       name="password",
    *       in="query",
    *       type="string",
    *       required=true,
    *       description="Password of the user"
    *    ),
    *    @SWG\Parameter(
    *       name="user_type",
    *       in="query",
    *       type="string",
    *       required=true,
    *       description="The value of user_type could be one of ***user***, ***manufacturer*** and ***technician***"
    *    ),
    *    @SWG\Response(
    *       response=200,
    *       description="User registered successfully"
    *    ),
    *    @SWG\Response(
    *       response=500,
    *       description="User registeration failed due to technical reasons"
    *    )
    * )
    */
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $user = new User($request->all());
        if(!$user->save()) {
            return response()->json([
                'status_code' => 500,
                'message' => 'User registeration failed due to technical reasons'
            ], 500);
        }
        
        return response()->json([
            'status_code' => 200,
            'message' => 'User registered successfully'
        ], 200);
    }
}
