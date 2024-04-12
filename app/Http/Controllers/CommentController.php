<?php

namespace App\Http\Controllers;

use App\Contracts\CommentContracts\CommentSortIndexContract;
use App\Contracts\CommentContracts\CommentTagHTMLContract;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentServices\CommentStoreService;
use Illuminate\Http\Request;

class CommentController extends Controller
{

//    protected CommentSortIndexContract $CommentSortIndexContract;
//
//    public function __construct(CommentSortIndexContract $CommentSortIndexContract)
//    {
//        $this->CommentSortIndexContract = $CommentSortIndexContract;    Один із варіантів виклику Сервіса
//    }

    public function index(Request $request, CommentSortIndexContract $CommentSortIndexContract)
    {
//        $comments = $this->CommentSortIndexContract->index($request); // Виклик через __construct
        $comments =$CommentSortIndexContract->index($request);
        $sortDirection = $request->input('sortDirection', 'desc'); // Значення за замовчуванням
        return view('comment', compact('comments', 'sortDirection'));
    }
    public function store(CommentRequest $request,  CommentTagHTMLContract $commentTagHTMLContract, CommentStoreService $commentService)
    {
        if (!$commentTagHTMLContract->validateTagComment($request)) {
            return redirect()->back()->withInput()->with('error', 'Невірні теги в коментарі');
        }

        $commentService->storeComment($request);

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
        return redirect()->route('/comments.index');
    }

    public function reloadCaptcha(){
        return response()->json(['captcha'=>captcha_img()]);
    }

}
