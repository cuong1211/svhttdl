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
    public function index(Request $request): View
    {
        $menus = Menu::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('title', 'like', '%' . $request->search . '%')
            )->with('parent')->latest()->paginate(10)->appends($request->all());
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
    public function store(MenuRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        $category = menu::create([
            'title' => $data['title'],
            'title_en' => $data['title_en'],
            'user_id' => $data['user_id'],
            'in_menu' => $data['in_menu'],
            'link' => $data['link'],
            'parent_id' => $data['parent_id'],
        ]);

        return redirect()->route('admin.menus.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Thêm mới menu thành công',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        $data = $request->validated();
        $menu->update([
            'title' => $data['title'],
            'title_en' => $data['title_en'],
            'user_id' => $data['user_id'],
            'in_menu' => $data['in_menu'],
            'link' => $data['link'],
            'parent_id' => $data['parent_id'],
            'order' => $data['order'],
        ]);
        $queryParams = $request->except(array_keys($data));
        return redirect()->route('admin.menus.index', $queryParams)->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Sửa menu thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        if ($menu->children->count() > 0) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Error',
                'message' => 'Menu này có menu con, không thể xóa',
            ]);
        } else {
            $menu->delete();
            return back()->with([
                'icon' => 'success',
                'heading' => 'Success',
                'message' => 'Xóa menu thành công',
            ]);
        }
    }
}
