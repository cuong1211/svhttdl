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
                ->paginate(10),
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
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $signer = Signer::updateOrCreate(
            ['name' => $request->name],
            $data
        );
        if ($signer->wasRecentlyCreated) {
            return back()->with([
                'icon' => 'success',
                'heading' => 'Thêm mới',
                'message' => trans('admin.alert.success'),
            ]);
        } else {
            return back()->with([
                'icon' => 'info',
                'heading' => 'Updated',
                'message' => trans('admin.alert.update'),
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

        $signer->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.signers.index')->with([
            'icon' => 'info',
            'heading' => 'Cập nhật',
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

        // Kiểm tra xem phòng ban có nhân viên nào không
        if ($signer->documents()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Lỗi',
                'message' => trans('admin.alert.erro.signer.deleted'),
            ]);
        }

        // Xóa phòng ban
        $signer->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
