<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Config;

abstract class Repository
{
    protected $model = false;
    public function get()
    {
        $builder = $this->model->select('*');
        return $builder->get();
    }

}
