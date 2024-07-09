<?php

namespace App\Http\Controllers\Api;

use App\Data\Authentication\UserLoginRequestData;
use App\Data\Authentication\UserLoginResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Repositories\UserRepository;
use App\Services\JsonResponseService;
use App\Services\LoggerService;
use Illuminate\Http\Request;

class AuthenticationController extends Controller {
    public $data;

    public function __construct(
        public JsonResponseService $jsonResponseService,
        public LoggerService       $logger,
        protected UserRepository   $userRepository,
    ) {
        $this->data = new \stdClass();
    }

    public function login(LoginUserRequest $request) {
        try {
            // varifying email or username
            $requestData = UserLoginRequestData::from($request);
            // getting a user with profile, gender and state
            $user = $this->userRepository->findUser(
                ["email" => $requestData->email_username],
                ["username" => $requestData->email_username]
            );
            if (is_null($user))
                return $this->jsonResponseService->fail(401, [
                    "email_username" => ["El email o username no existe."]
                ]);

            // verifying password
            $token = auth('api')->attempt([
                'email' => $user->email,
                'password' => $requestData->password,
                'user_state_id' => 1
            ]);
            if($token === false)
                return $this->jsonResponseService->fail(401, [
                    "password" => ["El password es incorrecto"]
                ]);

            $responseData = UserLoginResponseData::from([
                "access_token" => $token,
                "token_type" => "Bearer",
                "expires_in" => auth()->factory()->getTTL() * 60,
                "user" => $user->toArray(),
            ]);
            return $this->jsonResponseService->success(200, $responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->error(500);
        }
    }

    public function logout(Request $request) {
        try {
            auth()->logout();
            return $this->jsonResponseService->success(200);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->error(500);
        }
    }
}
