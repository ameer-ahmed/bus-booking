<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getAll(array $columns = ['*'], array $relations = []): Collection;

    public function getById(
        int   $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;

    public function create(array $payload): ?Model;

    public function getFirst(): ?Model;

    public function update(int $modelId, array $payload): bool;

    public function delete(int $modelId): bool;

    public function paginate(int $perPage = 10, array $relations = []);

}
