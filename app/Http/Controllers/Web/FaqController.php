<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return view('web.faq.index');
    }
    public function create()
    {
        return view('web.faq.create');
    }
    public function show()
    {
        return view('web.faq.show');
    }
}
