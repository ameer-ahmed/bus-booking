<?php

namespace App\Repository\Eloquent;

use App\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function getById(
        int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }

    public function getFirst(): ?Model {
        return $this->model->first();
    }

    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    public function update(int $modelId, array $payload): bool
    {
        $model = $this->getById($modelId);

        return $model->update($payload);
    }

    public function delete(int $modelId): bool
    {
        return $this->getById($modelId)->delete();
    }

    public function paginate(int $perPage = 10, array $relations = [])
    {
        return $this->model->with($relations)->paginate($perPage);
    }

}
