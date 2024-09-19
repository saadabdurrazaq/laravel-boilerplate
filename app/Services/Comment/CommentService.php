<?php

namespace App\Services\Comment;

use Illuminate\Http\Request;
use App\Repositories\Comment\CommentRepository;
use App\Http\Requests\API\Comment\CommentStoreRequest;
use App\Http\Requests\API\Comment\CommentUpdateRequest;
use App\Models\Post;

class CommentService
{
  public $request;
  protected $commentRepository;

  public function __construct(Request $request, CommentRepository $commentRepository)
  {
    $this->commentRepository = $commentRepository;
    $this->request = $request;
  }

  public function createData(CommentStoreRequest $request, $post)
  {
    return $this->commentRepository->create($request, $post);
  }
}
