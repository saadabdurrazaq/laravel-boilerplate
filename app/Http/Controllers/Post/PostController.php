<?php

namespace App\Http\Controllers\Post;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Post\PostService;
use App\Http\Requests\API\Post\PostStoreRequest;
use App\Http\Requests\API\Post\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        try {
            $result = $this->postService->index();
        } catch (\Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->postService->createData($request);
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);

        try {
            $result = $this->postService->show($post);
        } catch (\Exception $exception) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 500,
                    'message' => $exception->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = Post::find($id);
            if (!$data) {
                return apiErrorGetResponse(new \Exception('Data not found'), 'Data not found', [
                    'status' => Response::HTTP_NOT_FOUND,
                ]);
            }

            $result = $this->postService->updateData($data, $request);

            DB::commit();

            return response()->json($result);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());

            return response()->json(['message' => $exception->getMessage(), 'errors' => []], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        try {
            DB::beginTransaction();
            $data = Post::find(request('id'));
            if (!$data) {
                return response(['message' => 'Data not found', 'data' => (object) []], 404);
            }

            $result = $this->postService->forceDeleteById($data);
            DB::commit();

            return response()->json($result);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());

            return response()->json(['message' => $exception->getMessage(), 'data' => []], 500);
        }
    }
}
