<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.faqs.index', [
            'faqs' => Faq::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('name', 'like', '%'.$request->search.'%')
                )
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $faq = new Faq([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'question' => $request->question,
        ]);
        $faq->save();

        return redirect()->route('admin.faqs.index');
    }

    /**
     * @return Factory|View
     */
    public function show(Faq $faq): View
    {
        $faq->timestamps = false;
        $faq->update([
            'read_at' => now()->format('d.m.Y h:i'),
        ]);
        $faq->timestamps = true;

        return view('admin.faqs.show', compact('faq'));
    }

    public function update(Faq $faq, Request $request): RedirectResponse
    {
        $request->validate([
            'answer' => 'required',
        ]);

        $faq->update(['answer' => $request->answer]);

        if (! $faq->answer_at) {
            $faq->update(['answer_at' => now()->format('d.m.Y h:i')]);
        }

        return redirect()->route('admin.faqs.index');
    }

    /**
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
