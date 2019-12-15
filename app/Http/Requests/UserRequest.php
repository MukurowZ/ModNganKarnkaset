<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST':
                return [
                    'userId' => 'required|unique:user,userId',
                    'email' => 'required|email|unique:user,email',
	                'password' => 'required',
                    'name' => 'required',
                    'lastname' => 'required',
                    'department_id' => 'required|exists:department,id',
                    'permission' => 'required|in:owner,admin,staff,premium,user'
                ];
            case 'PUT':
                return [
                    'email' => 'email',
	                'password' => '',
                    'name' => '',
                    'lastname' => '',
                    'department_id' => 'exists:department,id',
                    'permission' => 'in:owner,admin,staff,premium,user'
                ];
            default:
                return [];
        }
    }
}
