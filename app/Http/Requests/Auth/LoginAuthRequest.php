<?php

namespace App\Http\Requests\Auth;

class LoginAuthRequest extends AbstractAuthRequest
{

    public function rules()
    {
        return  [
            'email' => 'string|required|email',
            'password' => 'string|required|min:8',
        ];
    }
}
