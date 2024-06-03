<?php

namespace App\Http\Requests;

use App\Rules\Password;
use App\Services\ApiResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginUserRequest extends FormRequest {

    public function __construct(
        protected ApiResponseService $apiResponse,
    ) {
        //
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            "email_username" => [
                "required",
                "max:255"
            ],
            "password" => [
                "required",
                "min:8",
                new Password
            ]
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            $this->apiResponse->responseHttp422($validator->errors())
        );
    }
}
