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
            $requestData = UserLoginRequestData::from($request);
            // getting a user with profile, gender and state
            $user = $this->userRepository->findUser(
                ["email" => $requestData->email_username],
                ["username" => $requestData->email_username]
            );
            if (is_null($user))
                return $this->jsonResponseService->http401();
            $token = auth('api')->attempt([
                'email' => $user->email,
                'password' => $requestData->password,
                'user_state_id' => 1
            ]);
            $responseData = UserLoginResponseData::from([
                "access_token" => $token,
                "token_type" => "Bearer",
                "expires_in" => auth()->factory()->getTTL() * 60,
                "user" => $user->toArray(),
            ]);
            return $this->jsonResponseService->http200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
    }

    public function logout(Request $request) {
        try {
            auth()->logout();
            return $this->jsonResponseService->http200();
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->jsonResponseService->http500();
        }
    }
}
