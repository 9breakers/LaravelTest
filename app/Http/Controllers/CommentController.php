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
            ->with('replies')->orderBy($sortBy, $sortDirection)->paginate(25);
        $comments->appends(['sortBy' => $sortBy, 'sortDirection' => $sortDirection]);

        Paginator::useBootstrap();
        return view('comment', compact('comments', 'sortBy', 'sortDirection'));
    }

    public function reloadCaptcha(){
        return response()->json(['captcha'=>captcha_img()]);
    }


    public function store(CommentRequest $request)
    {
        $comment = Comment::create([
            'text' => $request->input('text'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'parent_id' => null,
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $mimeType = $file->getMimeType();
            $folder = '';

            if (strpos($mimeType, 'image/') === 0) {
                $folder = 'images';
            } elseif (strpos($mimeType, 'text/') === 0) {
                $folder = 'text';
            } else {

                $folder = 'other';
            }
            $filePath = $file->storeAs("public/{$folder}", $fileName);
            $comment->image = str_replace('public', 'storage', $filePath);
            $comment->save();
        }
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
}
