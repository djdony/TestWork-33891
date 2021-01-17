<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployee extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'filled|unique:App\Models\Employee,name,'.$this->id,
            'pay_rate' => 'filled|numeric',
            'job_title' => 'filled|string',
            'active' => 'filled|boolean',
        ];
    }
}
