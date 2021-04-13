<?php

namespace App\Http\Controllers;

use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use Lavary\Menu\Menu;

class SiteController extends Controller
{
    protected $p_rep;
    protected $a_rep;
    protected $s_rep;
    protected $m_rep;
    protected $template;
    protected $vars = array();
    protected $bar = false;
    protected $content_rightBar = false;
    protected $content_leftBar = false;

    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }
    protected function renderOutput ()
    {
        $menu = $this->getMenu();
        $navigation = view(env('theme').'.navigation')->with(['menu'=>$menu]);
        $this->vars['navigation'] = $navigation;
        if ($this->content_rightBar)
        {
            $rightBar = view(env('theme').'.rightBar')->with(['content_rightBar'=>$this->content_rightBar])->render();
            $this->vars['rightBar'] = $rightBar;
        }


        return view($this->template)->with($this->vars);
    }
    protected function getMenu()
    {
        $menu = $this->m_rep->get();

        $mBuilder = \Menu::make('MyNavBar', function ($m) use ($menu) {
            foreach ($menu as $item)
            {
                if ($item->parent == 0) {
                    $m->add($item->title, $item->path)->id($item->id);
                }
                else
                {
                    if($m->find($item->parent))
                    {
                        $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
                    }
                }
            }
        });
        return $mBuilder;
    }
}
