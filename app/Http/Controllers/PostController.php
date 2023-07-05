<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('post/Index');
    }

    /**
     * Display a create page of the resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('post/Create', [
            'user' => request()->user(),
        ]);
    }

    /**
     * Display a specific resource on page.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response
    {
        return Inertia::render('post/Show', [
            'post' => $post
        ]);
    }

    /**
     * Display an edit page of the resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post): Response
    {
        return Inertia::render('post/Edit', [
            'post' => $post
        ]);
    }
}
