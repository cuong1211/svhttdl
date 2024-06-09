<?php

namespace App\Services;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    public function getCachedMenu(): Collection
    {
        if (Cache::get('menu')) {
            return Cache::get('menu');
        }
        return $this->cachedMenu();
    }

    public function cachedMenu(): Collection
    {
        return Cache::rememberForever('menu', function () {
            return Menu::query()
                ->with('children')
                ->whereNull('parent_id')
                ->where('in_menu', true)
                ->orderBy('order')
                ->get();
        });
    }

    public function deleteCachedMenu(): void
    {
        Cache::forget('menu');
    }
    public function getMenuList()
    {
        $menu = Menu::orderBy("id","asc")->get();
        return $menu;
    }
    public function create($data)
    {
        $create = Menu::create($data);
        return $create;
    }
    public function edit($data, $id)
    {
        $Menu = Menu::find($id)
            ->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
            ]);
        return $Menu;
    }
    public function delete($id)
    {
        $delete = Menu::find($id)
            ->delete();
        return $delete;
    }
    // public function search($request)
    // {
    //     $search = $this->index()->where('name', 'like', '%' . $request->search_table . '%');
    //     return $search;
    // }
}