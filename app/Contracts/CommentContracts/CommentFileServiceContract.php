<?php

namespace App\Contracts\CommentContracts;

use Illuminate\Http\UploadedFile;

interface CommentFileServiceContract
{
    public function handleFile(UploadedFile $file);
}
