<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Comment\CommentService;
use App\Http\Requests\API\Comment\CommentStoreRequest;
use App\Http\Requests\API\Comment\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentStoreRequest $request)
    {
        $postId = request('post_id');
        $post = Post::find($postId);

        try {
            DB::beginTransaction();
            $result = $this->commentService->createData($request, $post);
            DB::commit();

            return response()->json($result);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());

            return apiErrorGetResponse(
                $exception,
                'Data failed to store',
                ['status' => Response::HTTP_INTERNAL_SERVER_ERROR]
            );
        }
    }
}
