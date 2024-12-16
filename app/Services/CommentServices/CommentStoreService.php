<?php

namespace App\Services\CommentServices;

use App\Contracts\CommentContracts\CommentFileServiceContract;
use App\Contracts\CommentContracts\CommentStoreContract;
use App\Models\Comment;

class CommentStoreService implements CommentStoreContract
{
    protected CommentFileServiceContract $commentFileService;

    public function __construct(CommentFileServiceContract $commentFileService)
    {
        $this->commentFileService = $commentFileService;
    }

    public function storeComment($request)
    {
        $commentText = e($request->input('text'));

        $comment = Comment::create([
            'text' => $commentText,
            'username' => e($request->input('username')),
            'email' => e($request->input('email')),
            'parent_id' => null,
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $this->commentFileService->handleFile($file);
            $comment->image = $filePath;
            $comment->save();
        }

        return $comment;
    }
}
