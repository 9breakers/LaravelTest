<?php

namespace App\Contracts\CommentContracts;
use Illuminate\Http\Request;
interface CommentSortIndexContract{

    public function index(Request $request);
}
