<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RichTextAttachmentController extends Controller
{
    public function __invoke(Request $request): array
    {
        $request->validate([
            'model' => 'required|string',
            'attachment' => 'required|file',
        ]);

        // Generate the storage path including the original filename
        $originalFilename = $request->file('attachment')->getClientOriginalName();
        $path = $request->file('attachment')->storeAs(
            'trix-attachments/'.$request->model, $originalFilename, 'public'
        );

        return [
            'image_url' => Storage::disk('public')->url($path),
        ];
    }
}
