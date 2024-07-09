<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
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
            ->paginate(10);
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'reference_number' => 'required|string|max:255',
            'notes' => 'required|string',
            'published_at' => 'required|date'
        ]);

        $document = Document::create($request->only(['name', 'content', 'reference_number', 'published_at', 'notes', 'type_id', 'signer_id']));

        if ($request->hasFile('document_file')) {
            $imageFile = $request->file('document_file');
            $document->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('document_file');
        }

        return redirect()->route('admin.documents.index')->with('success', 'Tài liệu đã được tạo thành công.');
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
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'reference_number' => 'required|string|max:255',
            'notes' => 'required|string',
            'published_at' => 'required|date',
            'type_id' => 'required|exists:types,id',
            'signer_id' => 'required|exists:signers,id',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,bmp|max:2048'
        ]);

        $document->update($request->only([
            'name',
            'content',
            'reference_number',
            'published_at',
            'notes',
            'type_id',
            'signer_id'
        ]));

        // Assuming document has `signers` and `types` relationships
        // If these relationships are many-to-many
        // You should ensure your Document model has these relationships defined
        if ($request->has('signer_id')) {
            $document->signers()->sync($request->signer_id);
        }

        if ($request->has('type_id')) {
            $document->types()->sync($request->type_id);
        }

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $document->clearMediaCollection('document_file');
            $document->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('document_file');
        }

        return redirect()->route('admin.documents.index')->with('success', 'Tài liệu đã được cập nhật thành công.');
    }


    /**
     * Remove the specified document from storage.
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
