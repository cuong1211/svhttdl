<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Document_Opinion\OpinionRequest;
use App\Models\Document_Opinion;
use App\Models\Opinion;
use Illuminate\Http\Request;

class Document_OpinionController extends Controller
{
    public function index()
    {
        $docs = Document_Opinion::query()->latest()->paginate(10);
        return view('web.document_opinion.index', [
            'docs' => $docs,
        ]);
    }
    public function show($id)
    {
        $opinions = Opinion::query()->where('document_id', $id)->latest()->paginate(10);
        $doc = Document_Opinion::find($id);
        return view('web.document_opinion.show', [
            'doc' => $doc,
            'opinions' => $opinions,
        ]);
    }
    public function store($id, OpinionRequest $request)
    {
        $data = $request->validated();
        Opinion::query()->create([
            'document_id' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
        return redirect()->route('doc_opi.success');
    }
    public function success()
    {
        return view('web.document_opinion.success');
    }
}
