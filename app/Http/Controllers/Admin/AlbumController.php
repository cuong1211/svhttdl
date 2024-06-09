<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.albums.index', [
            'albums' => Album::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('name', 'like', '%'.$request->search.'%')
                )
                ->latest()
                ->paginate(10),
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create(): View
    {
        return view('admin.albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
        ]);
        Album::create($request->all());

        return redirect()->route('admin.albums.index')->with('success', 'Album created successfully.');
    }

    /**
     * @return Factory|View
     */
    public function edit(Album $album): View
    {
        return view('admin.albums.edit')
            ->with([
                'album' => $album,
            ]);
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
        ]);

        $album->update($request->all());

        return redirect()->route('admin.albums.index')->with('success', 'Album updated successfully.');
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully.');
    }
}
