<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * Create a new instance.
     *
     * @param  Model  $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all data of repository.
     *
     * @param  array  $columns
     * @return mixed
     */
    public function all(array $columns = ['*']): mixed
    {
        return $this->model->all($columns);
    }

    /**
     * Retrieve all data of repository, paginated.
     *
     * @param  null  $limit
     * @param  array  $columns
     * @return mixed
     */
    public function paginate($limit = null, array $columns = ['*']): mixed
    {
        return $this->model->select($columns)->latest()->paginate($limit);
    }

    /**
     * Save a new entity in repository.
     *
     * @param  array  $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    /**
     * Return an entity.
     *
     * @param  int  $id
     * @return mixed
     */
    public function findOrFail(int $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Return an entity.
     *
     * @param  string  $key
     * @param  string  $value
     * @return mixed
     */
    public function findBy(string $key, string $value): mixed
    {
        return $this->model->where($key, $value)->first();
    }

    /**
     * Update an entity.
     *
     * @param  int  $id
     * @param  array  $newDataArray
     * @return mixed
     */
    public function update(int $id, array $newDataArray): mixed
    {
        $data = $this->model->where('id', $id);

        $data->update($newDataArray);

        return $data->first();
    }

    /**
     * Delete an entity.
     *
     * @param  array  $whereArray
     * @param  array  $newDataArray
     * @return bool|null
     */
    public function delete(int $id): bool|null
    {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * Update or create an entity.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values): mixed
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * DB Transaction Start
     *
     * @return void
     */
    public function DBTransactionStart()
    {
        \DB::beginTransaction();
    }

    /**
     * DB Transaction Commit
     *
     * @return void
     */
    public function DBTransactionCommit()
    {
        \DB::commit();
    }

    /**
     * DB Transaction Rollback
     *
     * @return void
     */
    public function DBTransactionRollback()
    {
        \DB::rollback();
    }
}
