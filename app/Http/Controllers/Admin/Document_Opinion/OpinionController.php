<?php

namespace App\Http\Controllers\Admin\Document_Opinion;

use App\Http\Controllers\Controller;
use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $opinions = Opinion::query()
            ->with('document_opinion')
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->latest()->paginate(10);
        // dd($opinions);
        return view('admin.doc_opi.opinions.index', compact('opinions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $opinion = Opinion::query()->findOrFail($id);;
        return view('admin.doc_opi.opinions.show', compact('opinion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $opinion = Opinion::findOrFail($id);
        $opinion->delete();
        return redirect()->route('admin.opinions.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Xóa ý kiến thành công',
        ]);
    }
}
