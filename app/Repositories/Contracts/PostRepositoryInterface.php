<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    public function getAllPosts():LengthAwarePaginator;

    public function getPostById(int $id): Model;

    public function create(array $attributes): Model;

    public function update(array $attributes, int $id): Model;

    public function delete(int $id): bool;
}