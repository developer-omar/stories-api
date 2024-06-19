<?php

namespace App\Http\Controllers\Api;

use App\Data\User\ChangeUserEmailRequestData;
use App\Data\User\ChangeUsernameRequestData;
use App\Data\User\ChangeUserPasswordRequestData;
use App\Data\User\ShowUserResponseData;
use App\Data\User\StoreUserRequestData;
use App\Data\User\StoreUserResponseData;
use App\Data\User\UpdateUserRequestData;
use App\Data\User\UpdateUserResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepository;
use App\Services\JsonResponseService;
use App\Services\LoggerService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class UserController extends Controller {
    //public $user;

    public function __construct(
        public JsonResponseService  $apiResponse,
        public LoggerService        $logger,
        public Authenticatable|null $user,
        protected UserRepository    $userRepository,
    ) {
        $this->user = auth()->user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) {
        try {
            $requestData = StoreUserRequestData::from($request);
            $user = $this->userRepository->save($requestData);
            $responseData = StoreUserResponseData::from($user->toArray());
            return $this->apiResponse->http200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->http500();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request) {
        try {
            $userId = (int)$request->route('id');
            $user = $this->userRepository->getById($userId);
            if (is_null($user))
                return $this->apiResponse->http404();
            $responseData = ShowUserResponseData::from([
                "user" => $user->toArray()
            ]);
            return $this->apiResponse->http200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->http500();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        try {
            $requestData = UpdateUserRequestData::from($request);
            $user = $this->userRepository->update($requestData, $this->user->id);
            if (is_null($user))
                return $this->apiResponse->http404();
            $responseData = UpdateUserResponseData::from([
                "user" => $user->toArray()
            ]);
            return $this->apiResponse->http200($responseData);
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->http500();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }

    public function changeEmail(Request $request) {
        try {
            $requestData = ChangeUserEmailRequestData::from($request);
            $checkPassword = $this->userRepository->checkPassword($requestData->password, $this->user->id);
            if (!$checkPassword)
                return $this->apiResponse->http400($this->getData());
            $this->userRepository->updateEmail($requestData, $this->user->id);
            return $this->apiResponse->http200();
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->http500();
        }
    }

    public function changeUsername(Request $request) {
        try {
            $requestData = ChangeUsernameRequestData::from($request);
            $checkPassword = $this->userRepository->checkPassword($requestData->password, $this->user->id);
            if (!$checkPassword)
                return $this->apiResponse->http400($this->getData());
            $this->userRepository->updateUsername($requestData, $this->user->id);
            return $this->apiResponse->http200();
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->http500();
        }
    }

    public function changePassword(Request $request) {
        try {
            $requestData = ChangeUserPasswordRequestData::from($request);
            $checkPassword = $this->userRepository->checkPassword($requestData->current_password, $this->user->id);
            if (!$checkPassword)
                return $this->apiResponse->http400($this->getData());
            $this->userRepository->updatePassword($requestData, $this->user->id);
            return $this->apiResponse->http200();
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return $this->apiResponse->http500();
        }
    }

    private function getData() {
        $data = new \stdClass();
        $data->error = "El password actual no es correcto.";
        return $data;
    }

}
