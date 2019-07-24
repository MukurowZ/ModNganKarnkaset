<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors,
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return;
            case 'POST':
                return [
                    'name' => 'required',
                    'story' => 'required',
                    'price' => 'required',
                    'img_set_id' => 'required|exists:img_set,id',
                    'description' => 'required',
                    'video' => 'required',
                    'type' => 'required',
                    'owner_id' => 'required|exists:user,id'
                ];
            case 'PUT':
                return [
                    'name' => '',
                    'story' => '',
                    'price' => '',
                    'img_set_id' => 'exists:img_set,id',
                    'description' => '',
                    'video' => '',
                    'type' => '',
                    'owner_id' => 'exists:user,id'
                ];
        }
    }
}
