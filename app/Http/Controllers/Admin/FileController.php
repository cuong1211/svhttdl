<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            // Lưu file vào storage/app/public/uploads
            $file->storeAs('public/uploads', $fileName);

            return back()->with('success', 'Upload file thành công');
        }

        return back()->with('error', 'Vui lòng chọn file');
    }
    public function index()
    {
        return view('admin.file');
    }
}
