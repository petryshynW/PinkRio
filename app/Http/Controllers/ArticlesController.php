<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use App\Repositories\ArticlesRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Support\Facades\Config;
use App\Repositories\CommentsRepository;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep, ArticlesRepository $a_rep, CommentsRepository $c_rep)
    {
        parent::__construct(new MenusRepository(new Menu()));
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->bar = 'right';
        $this->c_rep = $c_rep;

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
        $comments = $this->c_rep->get(['text','name','email','site','article_id','user_id'],$take);
        return $comments;
    }
    public function getPortfolios ($take)
    {
        $portfolios = $this->p_rep->get(['title','text','alias','customer','img','filter_alias'],$take);
        return $portfolios;
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
