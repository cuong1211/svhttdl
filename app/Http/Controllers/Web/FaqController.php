<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::query()->latest()->paginate(5);
        return view('web.faq.index',compact('faqs'));
    }
    public function create()
    {
        return view('web.faq.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required | min:3 | max:255 ',
            'email' => 'required|email | max:255 ',
            'phone' => 'required | min:10 | max:11 ',
            'address' => 'required | min:3 | max:255',
            'title' => 'required | min:3',
            'question' => 'required',
        ]);
        // dd($data);
        $data = (object) $data;
        $faq = new Faq();
        $faq->name = $data->name;
        $faq->email = $data->email;
        $faq->phone = $data->phone;
        $faq->address = $data->address;
        $faq->title = $data->title;
        $faq->question = $data->question;
        $faq->save();
        if ($faq) {
            return redirect()->route('faq.success')->with('success', 'Câu hỏi của bạn đã được gửi đi');
        }
    }
    public function show($id)
    {
        $faq = Faq::query()->where('id', $id)->with('answers')->first();
        return view('web.faq.show',compact('faq'));
    }
    public function success()
    {
        return view('web.faq.success');
    }
}
