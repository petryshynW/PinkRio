<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\ArticlesRepository;
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
    public function getPortfolios ()
    {
        $portfolios = $this->p_rep->get('*',false,true);
        if ($portfolios)
        {
            $portfolios->load('filter');
        }
        return $portfolios;
    }
}
