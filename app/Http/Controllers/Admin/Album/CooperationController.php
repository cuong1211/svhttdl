<?php

namespace App\Http\Controllers\Admin\Album;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CooperationRequest;
use App\Models\Album;
use App\Models\Cooperation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CooperationController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.albums.cooperations.index', [
            'cooperations' => Cooperation::query()
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
        $albums = Album::query()->select('id', 'name')->get();

        return view('admin.albums.cooperations.create', compact('albums'));
    }

    public function store(CooperationRequest $request)
    {
        $cooperation = new Cooperation([
            'album_id' => $request->album_id,
            'name' => $request->name,
            'link_website' => $request->link_website,
            'description' => $request->description,
        ]);
        $cooperation->save();
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $cooperation->addMediaFromRequest('image')
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('album_cooperation');
        }

        return redirect()->route('admin.cooperations.index')->with('success', 'cooperation created successfully.');
    }

    /**
     * @return Factory|View
     */
    public function edit($id): View
    {
        $cooperation = Cooperation::findOrFail($id);
        $albums = Album::query()->select('id', 'name')->get();

        return view('admin.albums.cooperations.edit', compact('albums', 'cooperation'));
    }

    public function update(Request $request, Cooperation $cooperation)
    {

        $cooperation->update([
            'album_id' => $request->album_id,
            'name' => $request->name,
            'link_website' => $request->link_website,
            'description' => $request->description,
        ]);
        if ($request->hasFile('image')) {
            $cooperation->clearMediaCollection('album_cooperation');
            $cooperation->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('album_cooperation');
        }

        return redirect()->route('admin.cooperations.index')->with('success', 'cooperation updated successfully.');
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Cooperation $cooperation)
    {
        $cooperation->delete();

        return redirect()->route('admin.cooperations.index')->with('success', 'cooperation deleted successfully.');
    }
}
