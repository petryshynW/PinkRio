<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = env('theme') . '.admin.index';
    }
    public function index()
    {



        if (!Auth::user())
        {
            abort(403);
        }
        else
        {
            if (Gate::denies('VIEW_ADMIN'))
            {
                abort(403);
            }
            $this->template = env('theme') . '.admin.index';
            $this->title = 'Панель адміністратора';

            return $this->renderOutput();
        }

    }
}
