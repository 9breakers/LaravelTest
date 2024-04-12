<?php
namespace App\Services\CommentServices;


use App\Contracts\CommentContracts\CommentSortIndexContract;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CommentSortIndexService implements CommentSortIndexContract {
    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'created_at');
        $sortDirection = $request->input('sortDirection', 'desc');

        $comments = Comment::whereNull('parent_id')
            ->with('replies')
            ->orderBy($sortBy, $sortDirection)
            ->paginate(25);

        $comments->appends(['sortBy' => $sortBy, 'sortDirection' => $sortDirection]);

        Paginator::useBootstrap();

        return $comments;
    }
}
