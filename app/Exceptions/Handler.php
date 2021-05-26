<?php

namespace App\Exceptions;

use App\Http\Controllers\SiteController;
use App\Models\Menu;
use App\Repositories\MenusRepository;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (\Exception $e,$request){
            $statusCode = $e;
            //dd($statusCode);
            switch ($statusCode)
            {
                case '404':
                    $obj = new SiteController(new MenusRepository(new Menu()));
                    $navigation =  view(env('theme').'.navigation')->with('menu',$obj->getMenu())->render();
                    //dd($navigation);
                    return response()->view(env('theme').'404',['bar'=>'no','title'=>'Сторінку не знайдено','navigation'=>$navigation]);
            }
        });
    }
}
