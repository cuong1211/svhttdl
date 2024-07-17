<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
    public function store($id, Request $request)
    {
        $request->validate([
            'name' => 'required | min:3 | max:255 ',
            'email' => 'required|email | max:255 ',
            'phone' => 'required | min:10 | max:11 ',
            'address' => 'required | min:3 | max:255',
            'title' => 'required | min:3',
            'content' => 'required',
        ]);
        Opinion::query()->create([
            'document_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return redirect()->route('doc_opi.success');
    }
    public function success()
    {
        return view('web.document_opinion.success');
    }
}
