<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Config;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Repository
{
    protected $model = false;

    public function get($select = '*',$take = false,$pagination = false,$where = false)
    {
        $builder = $this->model->select($select);
        if ($take)
        {
            $builder->take($take);
        }
        if($where)
        {
            $builder->where($where[0],$where[1]);
        }
        if ($pagination)
        {
            return $this->check($builder->paginate(\config('settings.paginate')));
        }
        return $this->check($builder->get());
    }

    protected function check($result)
    {
        if ($result->isEmpty())
        {
            return false;
        }
        $result->transform(function ($item,$key)
        {
            if (is_string($item->img) && is_object(json_decode($item->img)) && (json_last_error() == JSON_ERROR_NONE))
            {
                $item->img = json_decode($item->img);

            }
            return $item;

        });
        return $result;
    }

    public function one($alias, $attr = array())
    {
        $result = $this->model->where('alias',$alias)->first();
        return $result;
    }
}
