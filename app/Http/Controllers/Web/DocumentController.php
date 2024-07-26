<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Document\Document;
use App\Models\Document\Signer;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $docs = Document::query()
            ->when(
                $request->kind_id,
                fn ($query) => $query->where('tag_id', 'like', '%' . $request->kind_id . '%'),
            )->latest()->paginate(10)->appends($request->all());
        $kinds = Signer::query()->get();
        return view("web.document.index", compact("docs", "kinds"));
    }
    public function show($id)
    {
        $doc = Document::query()->findOrFail($id);
        $other_docs = Document::query()->where('id', '!=', $id)->latest()->paginate(10);
        return view("web.document.show", compact("doc", "other_docs"));
    }
}
