<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenusRequest;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Menu;
use App\Models\User;
use App\Repositories\ArticlesRepository;
use App\Repositories\MenusRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Collection;

class MenusController extends AdminController
{
    protected $m_rep;
    public function __construct(MenusRepository $m_rep, ArticlesRepository $a_rep, PortfoliosRepository $p_rep)
    {
        parent::__construct();
        $this->m_rep = $m_rep;
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;

        $this->template = env('theme').'.admin.menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $dd)
    {
        if (Gate::denies('VIEW_ADMIN_MENU'))
        {
            abort(403);
        }
        $menus = $this->getMenus();
        $this->content = view(env('theme').'.admin.menus_content')->with('menus',$menus)->render();
        return $this->renderOutput();
    }
    public function getMenus ()
    {
        $menu = $this->m_rep->get();
        if ($menu->isEmpty())
        {

            return false;
        }
        return \Menu::make('forMenuPart',function ($m) use ($menu){
            foreach ($menu as $item)
            {
                if ($item->parent == 0)
                {
                    $m->add($item->title,$item->path)->id($item->id);
                }

                else
                {
                    if ($m->find($item->parent))
                    {
                        $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
                    }
                }
            }
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = "Новий пункт меню";
        $tmp = $this->getMenus()->roots();
        $menus = $tmp->reduce(function ($returnMenus,$menu){
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
        },['0'=>'Батькывський пункт меню']);
        $categories = Category::select(['title','alias','parent_id','id'])->get();
        $list = array();
        $list[0] = 'Не використовуэться';
        $list['parent'] = 'Роздыл блогу';
        foreach ($categories as $cat)
        {
            if ($cat->parent_id == 0)
            {
                $list[$cat->title] = array();
            }
            else
            {
                $list[$categories->where('id',$cat->parent_id)->first()->title][$cat->alias] = $cat->title;
            }
        }
        $articles = collect($this->a_rep->get(['id','title','alias']));
        $articles = $articles->reduce(function($returnArticles, $article){
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        },[]);
        $filters = collect(Filter::select('id','alias','title')->get())->reduce(function ($returnFilters, $filter){
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
            },['parent'=>'Роздыл портфолыо']);
        $portfolios = collect($this->p_rep->get(['id','alias','title']))->reduce(function ($returnPortfolios, $portfolio){
                $returnPortfolios[$portfolio->alias] = $portfolio->title;
                return $returnPortfolios;
            },[]);
        $this->content = view(env('theme').'.admin.menus_create_content')->with(['menus'=> $menus,'categories'=>$list,'articles'=>$articles,'portfolios'=>$portfolios,'filters'=>$filters])->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenusRequest $request)
    {
        $result = $this->m_rep->addMenu($request);
        if (is_array($result) && !empty($result['error']))
        {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $this->title = "Редагування пункту меню - ".$menu->title;
        $type =false;
        $option = false;
        $route = (app('router')->getRoutes()->match(app('request')->create($menu->path)));
        $aliasRoute =$route->getName();
        $parameters = $route->parameters();

        if ($aliasRoute == 'articles.index' || $aliasRoute == 'articlesCat')
        {
            $type = 'blogLink';
            $option = isset($parameters['cat_alias']) ? $parameters['cat_alias'] : 'parent';
        }
        elseif ($aliasRoute == 'articles.show')
        {
            $type = 'blogLink';
            $option =isset($parameters['alias']) ? $parameters['alias'] : '';
        }
        elseif ($aliasRoute == 'portfolios.index')
        {
            $type = 'portfolioLink';
            $option ='parent';
        }
        elseif ($aliasRoute == 'portfolios.show')
        {
            $type = 'portfolioLink';
            $option =isset($parameters['alias']) ? $parameters['alias'] : '';
        }
        else
        {
            $type = 'customLink';
        }
        $tmp = $this->getMenus()->roots();
        $menus = $tmp->reduce(function ($returnMenus,$menu){
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
        },['0'=>'Батькывський пункт меню']);
        $categories = Category::select(['title','alias','parent_id','id'])->get();
        $list = array();
        $list[0] = 'Не використовуэться';
        $list['parent'] = 'Роздыл блогу';
        foreach ($categories as $cat)
        {
            if ($cat->parent_id == 0)
            {
                $list[$cat->title] = array();
            }
            else
            {
                $list[$categories->where('id',$cat->parent_id)->first()->title][$cat->alias] = $cat->title;
            }
        }
        $articles = collect($this->a_rep->get(['id','title','alias']));
        $articles = $articles->reduce(function($returnArticles, $article){
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        },[]);
        $filters = collect(Filter::select('id','alias','title')->get())->reduce(function ($returnFilters, $filter){
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        },['parent'=>'Роздыл портфолыо']);
        $portfolios = collect($this->p_rep->get(['id','alias','title']))->reduce(function ($returnPortfolios, $portfolio){
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        },[]);
       $this->content = view(env('theme').'.admin.menus_create_content')->with(['menu'=>$menu,'option'=>$option,'type'=>$type,'menus'=> $menus,'categories'=>$list,'articles'=>$articles,'portfolios'=>$portfolios,'filters'=>$filters])->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $result = $this->m_rep->updateMenu($request,$menu);
        if (is_array($result) && !empty($result['error']))
        {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $result = $this->m_rep->deleteMenu($menu);
        if (is_array($result) && !empty($result['error']))
        {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
