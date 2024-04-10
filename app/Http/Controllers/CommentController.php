<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'created_at');
        $sortDirection = $request->input('sortDirection', 'desc');

        $comments = Comment::whereNull('parent_id')
            ->with('replies')->orderBy($sortBy, $sortDirection)->paginate(2);
        $comments->appends(['sortBy' => $sortBy, 'sortDirection' => $sortDirection]);

        Paginator::useBootstrap();
        return view('comment', compact('comments', 'sortBy', 'sortDirection'));
    }

    public function reloadCaptcha(){
        return response()->json(['captcha'=>captcha_img()]);
    }

    public function store(CommentRequest $request)
    {
        Comment::create([
            'text' => $request->input('text'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'parent_id' => null,
        ]);

        return redirect()->route('comments.index');
    }


    public function showReplyForm($comment)
    {
        $comment = Comment::findOrFail($comment);

        return view('reply_form' ,['comment' => $comment]);
    }

    public function createReply(CommentRequest $request, $parentId)
    {
        Comment::create([
            'text' => $request->input('text'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'parent_id' => $parentId,
        ]);

        return redirect()->route('comments.index');
    }
}
