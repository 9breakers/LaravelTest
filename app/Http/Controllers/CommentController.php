<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){

        return view('comment');
    }

    public function reloadCaptcha(){
        return response()->json(['captcha'=>captcha_img()]);
    }

    public function captchaPost(Request $request){
        $request->validate([

            ]);
        return redirect('/comment');
    }
}
