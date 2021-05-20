<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = env('theme') . '.admin.index';
        if (\Illuminate\Support\Facades\Gate::denies('VIEW_ADMIN'))
        {
            echo "ok";

        }
        return $this->template = env('theme') . '.admin.index';
    }
    public function index()
    {
        if (!Auth::user())
        {
            abort(403);

        }
        $this->title = 'Панель адміністратора';

        return $this->renderOutput();
    }
}
