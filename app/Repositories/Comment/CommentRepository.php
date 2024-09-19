<?php

namespace App\Repositories\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Post;
use App\Models\SampleDiagram\MixRatioHasItem;
use Illuminate\Database\Query\Builder;
use App\Http\Requests\API\Comment\CommentStoreRequest;
use App\Http\Requests\API\Comment\CommentUpdateRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class CommentRepository
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(CommentStoreRequest $request, $post)
    {
        $data = Comment::create($request->validated() + [
            'commentator_id' => auth()->id(),
            'post_id' => $post->id
        ]);

        return $data;
    }
}
