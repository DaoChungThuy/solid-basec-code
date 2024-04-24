<?php

namespace App\Http\Requests\CreateUpdate;

use App\Http\Requests\BaseRequest;

class CreateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required|string|min:8|max:20',
        ];
    }
}
