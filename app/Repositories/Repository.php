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
        //dd($builder->get());
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
    public function transliterate ($string)
    {
        $str = mb_strtolower($string,'utf-8');
        $leter_array = array(
            'a'=>'а',
            'b'=>'б',
            'v'=>'в',
            'h' =>'г',
            'd'=>'д',
            'e'=>'е,є',
            'zh'=> 'ж',
            'z'=>'з',
            'y'=>'и',
            'i'=>'і',
            'j'=>'й',
            'k'=>'к',
            'l'=>'л',
            'm'=>'м',
            'n'=>'н',
            'o'=>'о',
            'p'=>'п',
            'r'=>'р',
            's'=>'с',
            't'=>'т',
            'u'=>'у',
            'f'=>'ф',
            'ch'=>'х',
            'ce'=>'ц',
            'sch'=>'щ',
            ''=>'ь',
            'ju'=>'ю',
            'ja'=>'я'
        );
        foreach ($leter_array as $engLet=>$ukrLet)
        {
            $ukrLet = explode(',',$ukrLet);
            $str = str_replace($ukrLet,$engLet,$str);
        }
        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/','-',$str);
        $str = trim($str,'-');
        return $str;
    }
}
