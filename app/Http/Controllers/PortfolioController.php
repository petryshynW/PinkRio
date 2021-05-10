<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\MenusRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;

class PortfolioController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep)
    {
        parent::__construct(new MenusRepository(new Menu()));

        $this->p_rep = $p_rep;
        $this->template = env('theme').'.portfolios';
    }
    public function index()
    {
        $this->title = 'Портфоліо';
        $this->keywords = 'keywords';
        $this->meta_desc = 'description';

        $portfolios = $this->getPortfolios();

        $content = view(env('theme').'.portfolios_content')->with(['portfolios'=>$portfolios])->render();
        $this->vars['content'] = $content;

        return $this->renderOutput();
    }
    public function getPortfolios ($take = false,$paginate = true)
    {
        $portfolios = $this->p_rep->get('*',$take,$paginate);
        if ($portfolios)
        {
            $portfolios->load('filter');
        }
        return $portfolios;
    }
    public function show($alias)
    {
        $portfolio = $this->p_rep->one($alias);

        $this->title = $portfolio->title;
        $this->meta_desc = $portfolio->meta_desc;
        $this->keywords = $portfolio->keywords;
        $portfolios=$this->getPortfolios(\config('settings.other_portfolios'),false);

        $content = view(env('theme').'.portfolio_content')->with(['portfolio'=>$portfolio,'portfolios'=>$portfolios])->render();
        $this->vars['content'] = $content;

        return $this->renderOutput();
    }
}
