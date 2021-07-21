<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsersController extends AdminController
{
    protected $us_rep;
    protected $rol_rep;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(RolesRepository $rol_rep, UsersRepository $us_rep)
    {
        parent::__construct();
        $this->us_rep = $us_rep;
        $this->rol_rep = $rol_rep;
        $this->template = env('theme').'.admin.users';
    }
    public function index()
    {
        if (Gate::denies('EDIT_USERS'))
        {
            abort(403);
        }
        $users = $this->us_rep->get();
        //dd($users[0]->id);
        $this->content = view(env('theme').'.admin.users_content')->with(['users'=>$users])->render();
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Новий користувач';
        $roles = $this->rol_rep->get();
        $roles->reduce(function($returnRoles, $role){
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        },[]);
        $this->content = view(env('theme').'.admin.users_create_content')->with(['roles'=>$roles])->render();
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
