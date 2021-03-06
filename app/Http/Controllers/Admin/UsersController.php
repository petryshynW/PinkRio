<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use function PHPUnit\Framework\isEmpty;

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
        $roles = $roles->reduce(function($returnRoles, $role){
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
    public function store(UserRequest $request)
    {
        $result = $this->us_rep->addUser($request);
        if (is_array($result) && !empty($result['error']))
        {
            return back()->with($result);
        }
        return redirect(route('admin'))->with($result);
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
    public function edit(User $user)
    {
        $this->title = 'Редагування користувача - '.$user->name;
        $roles = $this->rol_rep->get();
        $roles = $roles->reduce(function ($returnRoles , $role){

            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        },[]);
        $this->content = view(env('theme').'.admin.users_create_content')->with(['roles'=>$roles,'user'=>$user])->render();
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $user)
    {
        $result = $this->us_rep->updateUser($request,$user);
        if (is_array($result) && !empty($result['error']))
        {
            return back()->with($result);
        }
        return redirect('admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $result = $this->us_rep->deleteUser($user);
        if (is_array($result) && !empty($result['error']))
        {
            return back()->with($result);
        }
        return redirect('admin')->with($result);
    }
}
