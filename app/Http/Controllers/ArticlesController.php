<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use App\Repositories\ArticlesRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Support\Facades\Config;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep, ArticlesRepository $a_rep)
    {
        parent::__construct(new MenusRepository(new Menu()));
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->bar = 'right';

        $this->template = env('theme').'.articles';
    }
    public function index()
    {
        $articles = $this->getArticles();
        $content = view(env('theme').'.articles_content')->with(['articles'=>$articles])->render();
        $this->vars['content'] = $content;
        $comments = $this->getComments(\config('settings.recent_comments'));
        $portfolios=$this->getPortfolios(\config('settings.recent_portfolios'));
        $this->content_rightBar = view(env('theme').'.articles_bar')->with(['comments'=>$comments, 'portfolios' =>$portfolios]);
        return $this->renderOutput();
    }
    public function getComments ($take)
    {

    }
    public function getPortfolios ($take)
    {

    }
    public function getArticles($alias = false)
    {
        $articles = $this->a_rep->get(['title','alias','created_at','img','description','user_id','category_id','id'],false,true);
        if ($articles)
        {
            //$articles->load('user','category','comments');
        }
        return $articles;
    }
}
