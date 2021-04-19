<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
{
    use ApiResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => ['required'],
            'email'      => ['required', 'email'],
            'password'   => ['required'],
            'c_password' => ['required', 'same:password'],
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'email.email' => 'Email format is invalid!',
            'password.required' => 'Password is required!',
            'c_password.required' => 'Confirm Password is required!',
            'c_password.same:password' => 'Confirm Password should same with password!'
        ];
    }

    protected function failedValidation(Validator $validator){
        if (request()->wantsJson()) {
            throw new HttpResponseException($this->trJsonErrorForm($validator->errors(), 422, 'Unprocessable Entity'));
        }
    }
}
