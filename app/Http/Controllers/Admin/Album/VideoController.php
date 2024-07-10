<?php

namespace App\Http\Controllers\Admin\Album;

use App\Enums\AlbumTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use App\Models\Album;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.albums.videos.index', [
            'videos' => Video::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
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
        $albums = Album::query()
            ->where('type', AlbumTypeEnum::VIDEO)
            ->select('id', 'name')
            ->get();

        return view('admin.albums.videos.create', compact('albums'));
    }

    public function store(VideoRequest $request): RedirectResponse
    {
        if($request->is_active == 1) {
            Video::query()
                ->where('album_id', $request->album_id)
                ->update(['is_active' => 0]);
        }
        $video = Video::create($request->all());
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $video->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('thumbnail_video');
        }

        return redirect()->route('admin.videos.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Tạo video thành công',
        ]);
    }

    /**
     * @return Factory|View
     */
    public function edit($id): View
    {
        $video = Video::findOrFail($id);
        $albums = Album::query()->select('id', 'name')->get();

        return view('admin.albums.videos.edit')
            ->with([
                'video' => $video,
                'albums' => $albums,
            ]);
    }

    public function update(VideoRequest $request, Video $video)
    {
        $video->update([
            'album_id' => $request->album_id,
            'name' => $request->name,
            'video_id' => $request->video_id,
            'source' => $request->source,
            'is_active' => $request->is_active,
        ]);
        // other video update is_active to 0
        Video::query()
            ->where('id', '!=', $video->id)
            ->where('album_id', $request->album_id)
            ->update(['is_active' => 0]);

        return redirect()->route('admin.videos.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhập video thành công',
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Xóa thành công',
        ]);
    }
}
