<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PostController extends ApiController
{
    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->responseData(
            PostResource::collection($this->postRepository->getAllPosts())
                ->response()
                ->getData(true)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->postRepository->create($request->validated());

        return $this->response(
            'Post successfully created',
            [],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->responseData(
            PostResource::make($this->postRepository->getPostById($id))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $this->postRepository->update($request->validated(), $id);

        return $this->response('Post successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->postRepository->delete($id);

        return $this->response('Post successfully deleted');
    }
}
