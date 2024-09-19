<?php

namespace App\Services\Post;

use Illuminate\Http\Request;
use App\Repositories\Post\PostRepository;
use App\Http\Requests\API\Post\PostStoreRequest;
use App\Http\Requests\API\Post\PostUpdateRequest;
use App\Models\Post;

class PostService
{
  public $request;
  protected $postRepository;

  public function __construct(Request $request, PostRepository $postRepository)
  {
    $this->postRepository = $postRepository;
    $this->request = $request;
  }

  public function index()
  {
    return $this->postRepository->index();
  }

  public function createData(PostStoreRequest $request)
  {
    return $this->postRepository->create($request);
  }

  public function show($post)
  {
    return $this->postRepository->show($post);
  }

  public function updateData(Post $post, PostUpdateRequest $request)
  {
    return $this->postRepository->update($post, $request);
  }

  public function forceDeleteById(Post $post)
  {
    return $this->postRepository->forceDeleteById($post);
  }
}
