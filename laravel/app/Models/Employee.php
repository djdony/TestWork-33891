<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $fillable = [
        'name',
        'pay_rate',
        'job_title',
        'active',
    ];
}
