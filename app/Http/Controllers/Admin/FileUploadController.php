<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'max:10240'],
        ]);

        $file = $request->file('file');
        $date = now()->format('Y/m/d');
        $path = $file->store("public/uploads/{$date}");

        $attachment = Attachment::create([
            'original_name' => $file->getClientOriginalName(),
            'stored_path' => $path,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ]);

        return response()->json([
            'success' => true,
            'file' => [
                'id' => $attachment->id,
                'name' => $attachment->original_name,
                'size' => $attachment->file_size,
                'url' => Storage::url($path),
            ],
        ]);
    }

    public function delete(Attachment $attachment)
    {
        Storage::delete($attachment->stored_path);
        $attachment->delete();

        return response()->json([
            'success' => true,
            'message' => '파일이 삭제되었습니다.',
        ]);
    }
}
