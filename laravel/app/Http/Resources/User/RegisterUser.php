<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterUser extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
