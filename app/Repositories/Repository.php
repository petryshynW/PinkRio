<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Config;

abstract class Repository
{
    protected $model = false;
    public function get()
    {
        $builder = $this->model->select('*');
        //dd($builder);
        return $builder->get();
    }

}
