<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Menu;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('web.home');
    }
    public function showMenu()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('layouts.website', compact('menus'));
    }
}
