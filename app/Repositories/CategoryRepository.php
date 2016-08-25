<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository
{
    /**
     * @var \Eloquent
     */
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        $instance = $this->model->find($id);

        return $instance->update($attributes);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}