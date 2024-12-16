<?php

namespace App\Services\CommentServices;

use App\Contracts\CommentContracts\CommentTagHTMLContract;
use Illuminate\Http\Request;

class CommentTagHTMLService implements CommentTagHTMLContract
{
    public function validateTagComment(Request $request)
    {
        $allowedTags = ['a', 'code', 'i', 'strong'];
        $commentText = $request->input('text');

        foreach ($allowedTags as $tag) {
            $openingTagPattern = "/<$tag\b[^>]*>/";
            $closingTagPattern = "/<\/$tag>/";

            $openingTagCount = preg_match_all($openingTagPattern, $commentText);
            $closingTagCount = preg_match_all($closingTagPattern, $commentText);
            if ($openingTagCount !== $closingTagCount) {
                return false;
            }
        }

        if (preg_match("/<(?!\/?(" . implode('|', $allowedTags) . ")\b)[^>]+>/i", $commentText)) {
            return false;
        }

        return true;
    }
}
