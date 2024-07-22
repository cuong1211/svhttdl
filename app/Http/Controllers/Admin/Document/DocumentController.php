<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Document\DocumentRequest;
use App\Models\Document\Signer;
use App\Models\Document\Type;
use App\Models\Document\Document;
use Illuminate\Http\Request;
use Illuminate\View\View;


class DocumentController extends Controller
{
    /**
     * Display a listing of the Document.
     */
    public function index(Request $request): View
    {
        $documents = Document::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('name', 'like', '%' . $request->search . '%'),
            )
            ->when(
                $request->type_id,
                fn ($query) => $query->where('type_id', $request->type_id),
            )
            ->when(
                $request->kind_id,
                fn ($query) => $query->where('tag_id', $request->kind_id),
            )
            ->with('types', 'signers')
            ->latest()
            ->paginate(10)->appends($request->all());
        $kinds = Signer::query()->get();
        $types = Type::query()->get();
        return view('admin.documents.index', [
            'documents' => $documents,
            'kinds' => $kinds,
            'types' => $types,
            'request' => $request,
        ]);
    }


    /**
     * Show the form for creating a new document.
     */
    public function create()
    {
        $signers = Signer::all();
        $types = Type::all();
        return view('admin.documents.create', compact('signers', 'types'));
    }

    /**
     * Lưu một tài liệu mới vào cơ sở dữ liệu.
     */
    public function store(DocumentRequest $request)
    {
        $data = $request->validated();
        $document = Document::create([
            'name' => $data['name'],
            'content' => $data['content'],
            'reference_number' => $data['reference_number'],
            'notes' => $data['notes'],
            'published_at' => $data['published_at'],
            'type_id' => $data['type_id'],
            'tag_id' => $data['tag_id'],
        ]);

        if ($request->hasFile('document_file')) {
            $imageFile = $request->file('document_file');
            $document->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('document_file');
        }

        return redirect()->route('admin.documents.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Tạo văn bản thành công',
        ]);
    }


    /**
     * Show the form for editing the specified document.
     */
    public function edit(Document $document)
    {
        $signers = Signer::all();
        $types = Type::all();

        return view('admin.documents.edit', compact('document', 'signers', 'types'));
    }

    /**
     * Cập nhật tài liệu đã chỉ định trong cơ sở dữ liệu.
     */
    public function update(DocumentRequest $request, Document $document)
    {
        $data = $request->validated();

        $document->update([
            'name' => $data['name'],
            'content' => $data['content'],
            'reference_number' => $data['reference_number'],
            'notes' => $data['notes'],
            'published_at' => $data['published_at'],
            'type_id' => $data['type_id'],
            'tag_id' => $data['tag_id'],
        ]);
        if ($request->hasFile('document_file')) {
            $imageFile = $request->file('document_file');
            $document->clearMediaCollection('document_file');
            $document->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('document_file');
        }

        return redirect()->route('admin.documents.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Sửa văn bản thành công',
        ]);
    }


    /**
     * Remove the specified document from storage.
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->clearMediaCollection('document_file');
        $document->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
