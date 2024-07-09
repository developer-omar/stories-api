<?php

namespace App\Http\Requests;

use App\Services\JsonResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoryRequest extends FormRequest {

    public function __construct(
        protected JsonResponseService $jsonResponseService,
    ) {
        //
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            "title" => [
                "required",
                "max:80"
            ],
            "description" => [
                "required",
            ],
            "tags" => [
                "required",
            ],
            "rating" => [
                "required",
                Rule::in([0, 1]),
            ],
            "story_status" => [
                "required",
                Rule::in([0, 1]),
            ],
            "category" => [
                "required",
                "integer",
                "exists:categories,id"
            ],
            "audience_type" => [
                "required",
                "integer",
                "exists:audience_types,id"
            ],
            "copyright_type" => [
                "required",
                "integer",
                "exists:copyright_types,id"
            ],
            "cover_image" => [
                Rule::requiredIf($this->method() == "POST"),
                File::types(["png", "jpg", "jpeg"])
                    ->min(1)
                    ->max(2048)
                    //->dimensions(Rule::dimensions()->maxWidth(1000)->maxHeight(500))
            ],
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            $this->jsonResponseService->http422($validator->errors())
        );
    }
}
