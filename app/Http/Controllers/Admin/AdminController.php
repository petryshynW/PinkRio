<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lavary\Menu;

class AdminController extends Controller
{
    //
    protected $p_rep;
    protected $a_rep;
    protected $user;
    protected $template;
    protected $content = false;
    protected $title;
    protected $vars;

    public function __construct()
    {
       // dd(Auth::user());
    }
    public function renderOutput ()
    {
        $this->vars['title'] = $this->title;

        $menu = $this->getMenu();
        $navigation = view(env('theme').'.admin.navigation')->with(['menu'=>$menu])->render();
        $this->vars['navigation'] = $navigation;
        if ($this->content)
        {
            $this->vars['content'] = $this->content;
        }
        $footer = view(env('theme').'.admin.footer')->render();
        $this->vars['footer'] = $footer;

        return view($this->template)->with($this->vars);
    }
    public function getMenu()
    {
        return \Menu::make('adminMenu',function ($menu)
        {
            $menu->add('Статті','admin/articles');

           /* $menu->add('Портфоліо',array('route'=>'admin.articles.index'));
            $menu->add('Меню',array('route'=>'admin.articles.index'));
            $menu->add('Користувачі',array('route'=>'admin.articles.index'));
            $menu->add('Права користувачів',array('route'=>'admin.articles.index'));*/
        });
    }
}