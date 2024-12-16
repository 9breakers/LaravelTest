<?php

namespace App\Contracts\CommentContracts;

use Illuminate\Http\Request;

interface CommentTagHTMLContract
{
    public function validateTagComment(Request $request);
}
