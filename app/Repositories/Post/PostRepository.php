<?php

namespace App\Repositories\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\SampleDiagram\MixRatioHasItem;
use Illuminate\Database\Query\Builder;
use App\Http\Requests\API\Post\PostStoreRequest;
use App\Http\Requests\API\Post\PostUpdateRequest;
use App\Models\Comment;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class PostRepository
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // NOTE: I prefer to use raw query because it can be easier to debug, more readable, faster than eloquent, and suitable for complex queries.

    public function indexParentBuilder(): Builder
    {
        return DB::table('posts')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->selectRaw('
               posts.id as post_id,
               posts.author_id as author_id,
               users.name as author_name,
               posts.post_title as post_title,
               posts.post_content as post_content,
               posts.post_excerpt as post_excerpt,
               posts.post_date as post_date
            ')
            ->whereNull('posts.deleted_at')
            ->orderBy('posts.created_at', 'desc');
    }

    public function indexChildBuilder(array $postIds): Builder
    {
        return DB::table('comments')
            ->join('users', 'comments.commentator_id', '=', 'users.id')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->selectRaw('
                comments.id as comment_id,
                comments.comment_content as comment_content,
                comments.comment_date as comment_date,
                users.name as commentator_name,
                users.id as commentator_id,
                posts.post_title as post_title,
                posts.id as post_id
            ')
            ->whereIn('comments.post_id', $postIds)
            ->groupBy('comments.id');
    }

    public function index()
    {
        $items = request('per_page', 10);
        $currentPage = request('page', 1);

        DB::statement("SET SQL_MODE=''");

        $parents = $this->indexParentBuilder()->groupBy('posts.id')->forPage($currentPage, $items)->get();

        $parentIds = $parents->pluck('post_id')->toArray();

        $childerns = $this->indexChildBuilder($parentIds)->get();

        DB::statement("SET SQL_MODE=only_full_group_by");

        if ($parents) {
            foreach ($parents as $key => $value) {
                $value->comments = $childerns->where('post_id', $value->post_id)->values();
            }
        }

        $totalRecords =  $this->indexParentBuilder()->distinct()->count('posts.id');
        $trashedData = Post::onlyTrashed()->count();

        $paginatedData = paginateData(collect($parents), $items, $totalRecords, $currentPage);

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['posts'] = $paginatedData;
        $datas['trashed_posts'] = $trashedData;
        $datas['items_per_show'] = $items;

        return $datas;
    }

    public function show($post)
    {
        DB::statement("SET SQL_MODE=''");

        $parent = $this->indexParentBuilder()->where('posts.id', $post->id)->groupBy('posts.id')->first();
        $childerns = $this->indexChildBuilder([$parent->post_id])->get();

        DB::statement("SET SQL_MODE=only_full_group_by");

        if ($parent) {
            $parent->comments = $childerns;
        }

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['post'] = $parent;

        return $datas;
    }

    public function create(PostStoreRequest $request)
    {
        $data = Post::create($request->validated() + [
            'author_id' => auth()->id(),
        ]);

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['message'] = 'Data stored successfully!';
        $datas['data'] = $data;

        return $datas;
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        $post->update($request->validated() + [
            'author_id' => auth()->id(),
        ]);

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['message'] = 'Data updated successfully!';
        $datas['data'] = $post;

        return $datas;
    }

    public function forceDeleteById(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();

        if ($comments->isNotEmpty()) {
            $comments->each(function ($comment) {
                $comment->forceDelete();
            });
        }

        if ($post) {
            $post->forceDelete();
        }

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['message'] = 'Data deleted successfully!';

        return $datas;
    }
}
