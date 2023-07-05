<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    /** @var int  */
    private const POSTS_PER_PAGE = 9;

    /**
     * @param Post $model
     */
    public function __construct(protected Post $model)
    {
    }

    /**
     * @param int|null $postsPerPage
     * @return LengthAwarePaginator
     */
    public function getAllPosts(int|null $postsPerPage = null): LengthAwarePaginator
    {
        return $this->model->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($postsPerPage ?? self::POSTS_PER_PAGE);
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