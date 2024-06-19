<?php

namespace App\Http\Requests;

use App\Rules\AlphaWhiteSpace;
use App\Rules\Password;
use App\Services\JsonResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest {
    public function __construct(
        protected JsonResponseService $apiResponse,
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
            "name" => [
                "required",
                new AlphaWhiteSpace,
                "max:255",
            ],
            "last_name" => [
                "required",
                new AlphaWhiteSpace,
                "max:255",
            ],
            "birth_date" => [
                "required",
                "date",
            ],
            "email" => [
                "required",
                "max:255",
                "email",
                Rule::unique("users", "email"),
            ],
            "username" => [
                "required",
                "max:30",
                Rule::unique("users", "username"),
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
            $this->apiResponse->http422($validator->errors())
        );
    }
}
