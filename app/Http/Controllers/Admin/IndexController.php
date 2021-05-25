<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = env('theme') . '.admin.index';


        return $this->template = env('theme') . '.admin.index';
    }
    public function index()
    {
        if (Gate::allows('VIEW_ADMIN'))
        {
            echo "ok";

        }
        if (!Auth::user())
        {
            abort(403);

        }
        $this->title = 'Панель адміністратора';

        return $this->renderOutput();
    }
}
