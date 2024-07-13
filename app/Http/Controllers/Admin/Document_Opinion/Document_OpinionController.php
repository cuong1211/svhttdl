<?php

namespace App\Http\Controllers\Admin\Document_Opinion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Document_Opinion\Document_OpinionRequest;
use App\Models\Document_Opinion;
use Illuminate\Http\Request;

class Document_OpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docs = Document_Opinion::query()->latest()->paginate(10);
        return view('admin.doc_opi.docs.index', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doc_opi.docs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Document_OpinionRequest $request)
    {
        $data  = $request->validated();
        $document = Document_Opinion::create([
            'name' => $data['name'],
            'content' => $data['content'],
            'note' => $data['note'],
            'start_date' => $data['start_at'],
            'end_date' => $data['end_at'],

        ]);
        if ($request->hasFile('document_file')) {
            $imageFile = $request->file('document_file');
            $document->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('document_file');
        }

        return redirect()->route('admin.docs-opis.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Tạo văn bản thành công',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document_Opinion $docs)
    {
        return view('admin.documents.edit', compact('docs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document_Opinion $docs)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
