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
        $albums = Album::query()
            ->where('type', AlbumTypeEnum::VIDEO)
            ->select('id', 'name')
            ->get();

        return view('admin.albums.videos.create', compact('albums'));
    }

    public function store(VideoRequest $request): RedirectResponse
    {
        Video::create($request->all());

        return redirect()->route('admin.videos.index')->with('success', 'Video created successfully.');
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
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully.');
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully.');
    }
}
