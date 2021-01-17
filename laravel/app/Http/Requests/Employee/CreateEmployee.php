<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployee extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|unique:App\Models\Employee,name',
            'pay_rate' => 'required|numeric',
            'job_title' => 'required|string',
            'active' => 'required|boolean',
        ];
    }
}
