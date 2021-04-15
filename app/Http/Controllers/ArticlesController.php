<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use App\Repositories\ArticlesRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Support\Facades\Config;
use App\Repositories\CommentsRepository;
use App\Models\Category;

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
    public function index($catAlias = false)
    {
        $articles = $this->getArticles($catAlias);
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
        if ($comments)
        {
            $comments->load('article','user');
        }
        return $comments;
    }
    public function getPortfolios ($take)
    {
        $portfolios = $this->p_rep->get(['title','text','alias','customer','img','filter_alias'],$take);
        return $portfolios;
    }
    public function getArticles($alias = false)
    {
        $where = false;

        if ($alias)
        {
            $id = Category::select('id')->where('alias',$alias)->first()->id;
            $where = ['category_id',$id];
        }
        $articles = $this->a_rep->get(['title','alias','created_at','img','description','user_id','category_id','id'],false,true,$where);
        if ($articles)
        {
            $articles->load('user','category','comments');
        }
        return $articles;
    }
    public function show($alias = false)
    {
        $article = $this->a_rep->one($alias,['comments'=>true]);
        dd($article);
        $content = view(env('theme').'.article_content')->with(['article'=>$article])->render();
        $this->vars['content'] = $content;
        $comments = $this->getComments(\config('settings.recent_comments'));
        $portfolios=$this->getPortfolios(\config('settings.recent_portfolios'));
        $this->content_rightBar = view(env('theme').'.articles_bar')->with(['comments'=>$comments, 'portfolios' =>$portfolios]);
        return $this->renderOutput();
    }
}
