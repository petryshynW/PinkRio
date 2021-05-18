<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = env('theme').'.admin.index';

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