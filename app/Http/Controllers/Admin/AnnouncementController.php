<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.announcements.index', [
            'announcements' => Announcement::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('title', 'like', '%' . $request->search . '%')
                )
                ->latest()
                ->paginate(10)->appends($request->all()),
        ]);
    }

    public function create(): View
    {
        return view('admin.announcements.create');
    }

    public function store(AnnouncementRequest $request): RedirectResponse
    {
        $announcement = new Announcement([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
        ]);
        $announcement->save();

        return redirect()->route('admin.announcements.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Tạo thông báo thành công',
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function edit($id): View
    {
        $announcement = Announcement::findOrFail($id);

        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Announcement $announcement, AnnouncementRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $announcement->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'published_at' => $data['published_at'],
        ]);
        $queryParams = $request->except(array_keys($data));
        return redirect()->route('admin.announcements.index', $queryParams)->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhập thông báo thành công',
        ]);
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
