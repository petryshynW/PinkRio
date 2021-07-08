<?php
namespace App\Repositories;

use App\Models\Article;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ArticlesRepository extends Repository
{
    public function __construct (Article $articles)
    {
        $this->model = $articles;
    }
    public function one($alias, $attr = array())
    {
        $article = parent::one($alias, $attr);
        if ($article && !empty($attr))
        {
            $article->load('comments');
            $article->comments->load('user');
        }
        return $article;

    }
    public function addArticle ($request)
    {
        if ( \Illuminate\Support\Facades\Gate::denies('save',$this->model))
        {
            abort(403);
        }
        $data = $request->except('_token','image');
        if (empty($data))
        {
            return ['error'=>'Ніц нема'];
        }
        if (!empty($data['alias']))
        {
            $data['alias'] = $this->transliterate($data['alias']);
        }
        if ($this->one($data['alias'],false))
        {
            $request->merge(array('alias'=>$data['alias']));
            $request->flash();
            return ['error'=>'Даний псевдонім уже використовується'];
        }
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            if ($image->isValid())
            {
                $str = Str::random(8);
                $obj = new \stdClass();
                $obj->mini = $str.'_mini.jpg';
                $obj->max = $str.'_max.jpg';
                $obj->path = $str.'.jpg';

                $img = Image::make($image);
                $img->fit(Config::get('settings.image')['width'],Config::get('settings.image')['height'])
                    ->save(public_path().'/'.env('theme').'/images/articles/'.$obj->path);
                $img->fit(Config::get('settings.articles_img')['max']['width'],Config::get('settings.articles_img')['max']['height'],)
                    ->save(public_path().'/'.env('theme').'/images/articles/'.$obj->max);
                $img->fit(Config::get('settings.articles_img')['max']['width'],Config::get('settings.articles_img')['max']['height'],)
                    ->save(public_path().'/'.env('theme').'/images/articles/'.$obj->mini);
               $data['img'] = json_encode($obj);
               $this->model->fill($data);
               if ($request->user()->articles()->save($this->model))
               {
                   return ['status' => 'Дані збережено'];
               }
            }
        }

    }
    public function updateArticle ($request, $article)
    {
        //винести в окремий метод
        if ( \Illuminate\Support\Facades\Gate::denies('edit',$this->model))
        {
            abort(403);
        }
        $data = $request->except('_token','image','_method');
        if (empty($data))
        {
            return ['error'=>'Ніц нема'];
        }
        if (!empty($data['alias']))
        {
            $data['alias'] = $this->transliterate($data['alias']);
        }
        $result = $this->one($data['alias'],false);
        //dd($article->alias);
        if (isset($result->id) && ($result->id !== $article->id))
        {
            $request->merge(array('alias'=>$data['alias']));
            $request->flash();
            return ['error'=>'Даний псевдонім уже використовується'];
        }
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            if ($image->isValid())
            {
                $str = Str::random(8);
                $obj = new \stdClass();
                $obj->mini = $str.'_mini.jpg';
                $obj->max = $str.'_max.jpg';
                $obj->path = $str.'.jpg';

                $img = Image::make($image);
                $img->fit(Config::get('settings.image')['width'],Config::get('settings.image')['height'])
                    ->save(public_path().'/'.env('theme').'/images/articles/'.$obj->path);
                $img->fit(Config::get('settings.articles_img')['max']['width'],Config::get('settings.articles_img')['max']['height'],)
                    ->save(public_path().'/'.env('theme').'/images/articles/'.$obj->max);
                $img->fit(Config::get('settings.articles_img')['max']['width'],Config::get('settings.articles_img')['max']['height'],)
                    ->save(public_path().'/'.env('theme').'/images/articles/'.$obj->mini);
                $data['img'] = json_encode($obj);

            }

        }
        $article->fill($data);
        if ($article->update())
        {
            return ['status' => 'Дані оновлено'];
        }

    }
    public function deleteArticle ($article)
    {
        if (\Illuminate\Support\Facades\Gate::denies('destroy',$article))
        {
            abort(403);
        }
        $article->comments()->delete();
        if ($article->delete())
        {
            return ['Матеріал видалено'];
        }
    }

}
