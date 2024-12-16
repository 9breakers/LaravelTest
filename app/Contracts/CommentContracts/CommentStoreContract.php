<?php

namespace App\Contracts\CommentContracts;

interface CommentStoreContract
{
    public function storeComment($request);
}
