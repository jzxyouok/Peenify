<?php

namespace App\Repositories;

abstract class Repository
{
    /**
     * @var \Eloquent
     */
    protected $model;

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $attributes = [])
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

    public function setSlugGenerator()
    {
        $this->model->setSlugGenerator(function($name) {
            return base64_encode($name);
        });
        return $this->model;
    }

    public function firstOrNew(array $attributes)
    {
        return $this->model->firstOrNew($attributes);
    }
}