<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Document\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $docs = Document::query()->latest()->paginate(10);
        return view("web.document.index", compact("docs"));
    }
}
