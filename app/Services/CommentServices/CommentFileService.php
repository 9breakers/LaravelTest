<?php

namespace App\Services\CommentServices;

use App\Contracts\CommentContracts\CommentFileServiceContract;
use Illuminate\Http\UploadedFile;

class CommentFileService implements CommentFileServiceContract
{
    public function handleFile(UploadedFile $file): string
    {
        $fileName = time() . '_' . $file->getClientOriginalName();

        $mimeType = $file->getMimeType();
        if (strpos($mimeType, 'image/') === 0) {
            $folder = 'images';
        } elseif (strpos($mimeType, 'text/') === 0) {
            $folder = 'text';
        } else {
            $folder = 'other';
        }

        $filePath = $file->storeAs("public/{$folder}", $fileName);
        return str_replace('public', 'storage', $filePath);
    }
}
