<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|max:255|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter your name.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name may not be greater than :max characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'The email address is not valid.',
            'email.unique' => 'The email address has already been taken.',
            'email.max' => 'Email may not be greater than :max characters.',
            'password.required' => 'Please enter your password.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least :min characters.',
            'password.max' => 'Password may not be greater than :max characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            response()->json([
                'error' => $validator->errors()
            ], 422)
        );
    }
}
