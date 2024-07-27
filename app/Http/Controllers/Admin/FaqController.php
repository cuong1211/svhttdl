<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
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
                    fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
                )
                ->latest()
                ->paginate(10)->appends($request->all()),
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

        return redirect()->route('admin.faqs.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Tạo câu hỏi thành công',
        ]);
    }

    /**
     * @return Factory|View
     */
    public function show(Faq $faq): View
    {
        $faq->with('answers')->first();
        $faq->timestamps = false;
        $faq->update([
            'read_at' => now()->format('d/m/Y h:i'),
        ]);
        $faq->timestamps = true;
        $answers = $faq->answers()->get();
        return view('admin.faqs.show', compact('faq', 'answers'));
    }

    public function update(Faq $faq, Request $request): RedirectResponse
    {
        $request->validate([
            'answer' => 'required',
        ]);

        // $faq->update(['answer' => $request->answer]);
        $answer = Answer::updateOrCreate([
            'faq_id' => $faq->id,
            'content' => $request->answer,
            'user_id' => auth()->id(),
            'status' => 0,
        ]);

        if (!$faq->answer_at) {
            $faq->update(['answer_at' => now()->format('d.m.Y h:i')]);
        }
        if ($answer) {
            return redirect()->route('admin.faqs.show', $faq->id)->with([
                'icon' => 'success',
                'heading' => 'Success',
                'message' => 'Trả lời câu hỏi thành công',
            ]);
        }
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
