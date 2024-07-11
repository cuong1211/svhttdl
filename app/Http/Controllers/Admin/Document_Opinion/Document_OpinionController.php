<?php

namespace App\Http\Controllers\Admin\Document_Opinion;

use App\Http\Controllers\Controller;
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
        //
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
        //
    }
}
