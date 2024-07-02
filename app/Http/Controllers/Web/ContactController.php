<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('web.contact.index');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required | min:3 | max:255 ',
            'email' => 'required|email | max:255 ',
            'phone' => 'required | min:10 | max:11 ',
            'title' => 'required | min:3',
            'content' => 'required',
        ]);
        // dd($data);
        $data = (object) $data;
        $contact = new Contact();
        $contact->name = $data->name;
        $contact->email = $data->email;
        $contact->phone = $data->phone;
        $contact->title = $data->title;
        $contact->content = $data->content;
        $contact->save();
        if($contact) {
            return redirect()->route('contact.success')->with('success', 'Câu hỏi của bạn đã được gửi đi');
        }
    }
    public function success()
    {
        return view('web.contact.success');
    }
}
