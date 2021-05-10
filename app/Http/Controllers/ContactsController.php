<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenusRepository;
use App\Models\Menu;

class ContactsController extends SiteController
{
    public function __construct()
    {
        parent::__construct(new MenusRepository(new Menu()));

        $this->bar = 'left';
        $this->template = env('theme').'.contacts';
        $this->title = 'Контактні дані';
    }
    public function index (Request $request)
    {
        if($request->isMethod('POST')) {
            $messages = array(
                'required' => 'Поло :attribute обовязкове для заповнення',
                'email' => 'Поле :attribute має відповідати email'
            );
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'
            ], $messages);
            $data = $request->all();

            $mail_admin = 'alll@dfgdf.com';
            $result = Mail::to($mail_admin);
            if ($result)
            {
                return redirect()->route('contacts')->with(['status'=>'Emails is send']);
            }
        }

        $content = view(env('theme').'.contact_content')->render();
        $this->content_leftBar = view(env('theme').'.contact_bar')->render();
        $this->vars['content'] = $content;
        return $this->renderOutput();

    }
}
