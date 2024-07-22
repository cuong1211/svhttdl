<?php

namespace App\Services;

use App\Http\Requests\MenuRequest;
use App\Models\Menu as MenuModel;
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
            return MenuModel::query()
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
        $menu = MenuModel::query()->latest()->paginate(10)->appends($request->all());;
        return $menu;
    }
    public function create($data)
    {
        $create = MenuModel::create($data);
        return $create;
    }
    public function edit($data, $id)
    {
        $Menu = MenuModel::find($id)
            ->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
            ]);
        return $Menu;
    }
    public function delete($id)
    {
        $delete = MenuModel::find($id)
            ->delete();
        return $delete;
    }
    // public function search($request)
    // {
    //     $search = $this->index()->where('name', 'like', '%' . $request->search_table . '%');
    //     return $search;
    // }
}