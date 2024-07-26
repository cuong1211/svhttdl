<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Document\SignerDocumentRequest;
use App\Models\Document\Signer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SignerDocumentController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.documents.signers.index', [
            'signers' => Signer::query()
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
        $signers = Signer::query()
            ->get();

        return view(
            'admin.documents.signers.create',
            [
                'signers' => $signers,
            ]
        );
    }
    public function store(SignerDocumentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $signer = Signer::create($data);
        if ($signer) {
            return redirect()->route('admin.signers.index')->with([
                'icon' => 'success',
                'heading' => 'success',
                'message' => trans('admin.alert.success'),
            ]);
        }
    }

    /**
     * @return RedirectResponse
     */
    public function edit($id): View
    {
        $signer = Signer::findOrFail($id);

        return view('admin.documents.signers.edit', compact('signer'));
    }

    public function update(SignerDocumentRequest $request, $id): RedirectResponse
    {
        $signer = Signer::findOrFail($id);
        $data = $request->validated();
        $signer->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
        $queryParams = $request->except(array_keys($data));
        return redirect()->route('admin.signers.index', $queryParams)->with([
            'icon' => 'success',
            'heading' => 'success',
            'message' => trans('admin.alert.update'),
        ]);
    }

    /**
     * Remove the specified signers only if it has no posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $signer = Signer::findOrFail($id);
        if ($signer->documents()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Lỗi',
                'message' => "Không thể xóa thể loại văn bản này vì đang có tài liệu thuộc thể loại này!",
            ]);
        }
        $signer->delete();
        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
