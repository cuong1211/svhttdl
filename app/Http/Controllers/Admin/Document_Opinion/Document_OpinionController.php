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
    public function index(Request $request)
    {
        $docs = Document_Opinion::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
            )
            ->latest()
            ->paginate(10)
            ->appends($request->all());
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
    public function edit($id)
    {
        $docs = Document_Opinion::findOrFail($id);

        return view('admin.doc_opi.docs.edit', compact('docs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Document_OpinionRequest $request, $id)
    {
        $data = $request->validated();
        $docs = Document_Opinion::findOrFail($id);
        $docs->update([
            'name' => $data['name'],
            'content' => $data['content'],
            'note' => $data['note'],
            'start_date' => $data['start_at'],
            'end_date' => $data['end_at'],
        ]);

        if ($request->hasFile('document_file')) {
            $imageFile = $request->file('document_file');
            $docs->clearMediaCollection('document_file');
            $docs->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('document_file');
        }
        $queryParams = $request->except(array_keys($data));
        return redirect()->route('admin.docs-opis.index', $queryParams)->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Sửa văn bản thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $document = Document_Opinion::findOrFail($id);
        $document->clearMediaCollection('document_file');
        $document->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
