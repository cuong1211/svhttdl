<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Faq;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($faqId, $answerId)
    {
        return view('admin.faqs.answer', [
            'faq' => Faq::findOrFail($faqId),
            'answer' => Answer::findOrFail($answerId),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $faqId, $answerId)
    {
        $answer = Answer::findOrFail($answerId);
        $answer->update([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'faq_id' => $faqId,
        ]);

        return redirect()->route('admin.faqs.show', $faqId)->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhật câu trả lời thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($answerId)
    {
        $answer = Answer::findOrFail($answerId);
        $answer->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Xóa câu trả lời thành công',
        ]);
    }
}
