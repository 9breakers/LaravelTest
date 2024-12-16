<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;  use App\Contracts\CommentContracts\CommentSortIndexContract;



class PintController extends Controller
{

    public function __construct(CommentSortIndexContract $CommentSortIndexContract)
        {
            $this->CommentSortIndexContract = $CommentSortIndexContract;
        }

    public function index() {

        $data = array(
            'user1' => 'John Doe',
            'user2' => 'Jane Doe'
        );

        $posts = [
            'post1' => 'Post 1',
            'post2' => 'Post 2',
        ];
        return view('test.index', compact('data', 'posts')); }
}
