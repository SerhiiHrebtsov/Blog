<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @param Post $model
     */
    public function __construct(protected Post $model)
    {
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAllPosts(): LengthAwarePaginator
    {
        return $this->model->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getPostById(int $id): Model
    {
        return $this->model->with('user')
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $model = $this->model->newInstance($attributes);
        $model->save();

        return $model;
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update(array $attributes, int $id): Model
    {
        $model = $this->model->findOrFail($id);

        $model->fill($attributes);
        $model->save();

        return $model;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->model->findOrFail($id);

        return $model->delete();
    }
}