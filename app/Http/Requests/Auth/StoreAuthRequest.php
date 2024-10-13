<?php

namespace App\Http\Requests\Auth;

class StoreAuthRequest extends AbstractAuthRequest
{
    public function rules()
    {
        return  [
            'email' => 'string|required|email|unique:users,email',
            'password' => 'string|required|min:8',
        ];
    }
}
