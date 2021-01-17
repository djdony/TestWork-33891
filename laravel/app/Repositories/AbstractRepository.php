<?php

namespace App\Repositories;

use App\Contracts\Repositories\AbstractRepositoryContract;
use Illuminate\Database\Eloquent\Model;


abstract class AbstractRepository implements AbstractRepositoryContract
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getById($id): ?Model
    {
        return $this->model->find($id);
    }
}
