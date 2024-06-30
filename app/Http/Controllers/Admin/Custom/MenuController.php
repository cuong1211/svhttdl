<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use App\Http\Requests\admin\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\Datatables\Datatables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $menuservice;
    public function __construct(MenuService $menuservice)
    {
        $this->menuservice = $menuservice;
    }
    public function index(): View
    {
        $menus = $this->menuservice->getMenuList();
        return view("admin.menus.index", compact("menus"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $menu = $this->menuservice->cachedMenu();
        return view("admin.menus.create", compact("menu"));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $category = menu::create($request->all());

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Thêm mới danh mục thành công',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        switch ($id) {
            case 'cached':
                $menus = $this->menuservice->cachedMenu();
                return Datatables::of($menus)->make(true);
                break;
            case 'get-list':
                $menus = $this->menuservice->getMenuList();
                // dd($menus);
                return Datatables::of($menus)->make(true);
                break;
            default:
                $menus = $this->menuservice->cachedMenu();
                return Datatables::of($menus)->make(true);
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu): View
    {

        $menus = $this->menuservice->cachedMenu();
        $selectedMenu = $menu;
        // dd($selectedMenu);
        return view('admin.menus.edit', compact('menus', 'selectedMenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        $menu->update($request->all());

        return redirect()->route('admin.menus.index')->with([
            'icon' => 'success',
            'message' => 'Cập nhật danh mục thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('Xóa thành công'),
        ]);
    }
}
