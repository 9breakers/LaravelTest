<?php

namespace App\Http\Controllers;

use App\Contracts\CommentContracts\CommentSortIndexContract;
use App\Contracts\CommentContracts\CommentTagHTMLContract;


class TestController extends Controller{

    public function __call($method, $parameters)
    {
        parent::__call($method, $parameters);
    }

}
