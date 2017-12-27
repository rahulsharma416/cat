<?php

namespace App\Api\V1\Controllers;

Use Log;
use Hash;
use App\Mail\SimplePCEmail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * @SWG\Swagger(
 *   host=API_HOST,
 *   schemes={"http"},
 *   @SWG\Info(
 *     title="API Documentation",
 *     version="1.0.0",
 *   )
 * )
 */

/**
 * @SWG\SecurityScheme(
 *   securityDefinition="token",
 *   type="apiKey",
 *   in="header",
 *   name="Authorization",
 *   scopes={
 *     "send:token": "Send the token"
 *   }
 * )
 */
class LoginController extends Controller
{
   /**
    * @SWG\Post(
    *    tags={"Common"},
    *    path="/auth/login",
    *    description="Authenticates a user",
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
    *    @SWG\Response(
    *       response=200,
    *       description="Returns JWT token which will be valid for sometime. You may need to store it in cache in order to access the other API's. In case of expired token, the user will need to re-login in order to get the new token."
    *    ),
    *    @SWG\Response(
    *       response=500,
    *       description="Error message"
    *    )
    * )
    */
    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $credentials = $request->only(['email', 'password']);
        $userId = null;
        try {
            $token = $JWTAuth->attempt($credentials);
            $user = $JWTAuth->authenticate($token);
            $userId = $user->getAuthIdentifier();

            if(!$token) {
                throw new AccessDeniedHttpException();
            }

        } catch (JWTException $e) {
            return response()
                ->json([
                    'status_code' => 500,
                    'message' => 'Invalid email/password'
                ]);
        }
        return response()
            ->json([
                'status_code' => 200,
                'user_id' => (string) $userId,
                'token' => $token
            ]);
    }
}
