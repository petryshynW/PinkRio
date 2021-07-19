<?php
namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Support\Facades\Gate;

class MenusRepository extends Repository
{
    public function __construct (Menu $menu)
    {
        $this->model = $menu;
    }
    public function addMenu($request)
    {
        if (\Illuminate\Support\Facades\Gate::denies('save',$this->model))
        {
            abort(403);
        }
        $data = $request->only('type','title','parent');
        dd($data);
    }

}
