<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'filled',
            'email' => 'filled|email|unique:users,email,'.$this->id,
            'password' => '',
            'c_password' => 'same:password',
        ];
    }
}
