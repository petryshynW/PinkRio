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
    protected $c_rep;
    protected $template;
    protected $vars = array();
    protected $bar = 'none';
    protected $content_rightBar = false;
    protected $content_leftBar = false;
    protected $keywords;
    protected $title;
    protected $meta_desc;

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
        if ($this->content_leftBar)
        {
            $leftBar = view(env('theme').'.leftBar')->with(['content_leftBar'=>$this->content_leftBar])->render();
            $this->vars['leftBar'] = $leftBar;
        }
        $this->vars['bar'] = $this->bar;

        $footer = view(env('theme').'.footer')->render();
        $this->vars['footer'] = $footer;

        $this->vars['keywords'] = $this->keywords;
        $this->vars['big_title'] = $this->title;
        $this->vars['meta_desc'] = $this->meta_desc;

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
