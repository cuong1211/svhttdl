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
                    fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
                )
                ->latest()
                ->paginate(10)->appends($request->all()),
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

        return redirect()->route('admin.cooperations.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Tạo dự án quân hệ thành công',
        ]);
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

    public function update(CooperationRequest $request, Cooperation $cooperation)
    {
        $data = $request->validated();
        $cooperation->update([
            'album_id' => $data['album_id'],
            'name' => $data['name'],
            'link_website' => $data['link_website'],
            'description' => $data['description'],
        ]);
        if ($request->hasFile('image')) {
            $cooperation->clearMediaCollection('album_cooperation');
            $cooperation->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('album_cooperation');
        }
        $queryParams = $request->except(array_keys($data));
        return redirect()->route('admin.cooperations.index', $queryParams)->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhập dự án thành công',
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Cooperation $cooperation)
    {
        $cooperation->clearMediaCollection('album_cooperation');
        $cooperation->delete();
        return redirect()->route('admin.cooperations.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Xóa dự án thành công',
        ]);
    }
}
