<?php namespace TGLD\Core;

use Illuminate\Database\Eloquent\Model;
use TGLD\Core\Exceptions\EntityNotFoundException;

abstract class EloquentRepository
{
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getLatest()
    {
        return $this->model->latest()->get();
    }

    public function getAllPaginated($count)
    {
        return $this->model->paginate($count);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function requireById($id)
    {
        $model = $this->getById($id);

        if ( ! $model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }

    public function save(Model $model)
    {
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }

    public function update(Model $model)
    {

    }

    public function getSlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }
}