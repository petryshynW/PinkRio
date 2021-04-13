<?php
namespace App\Repositories;

use App\Models\Articles;

class ArticlesRepository extends Repository
{
    public function __construct (Articles $articles)
    {
        $this->model = $articles;
    }

}
