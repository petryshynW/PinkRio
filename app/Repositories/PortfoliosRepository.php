<?php
namespace App\Repositories;
use App\Models\Portfolio;
class PortfoliosRepository extends \App\Repositories\Repository
{
    public function __construct (Portfolio $portfolio)
    {
        $this->model = $portfolio;
    }
}
