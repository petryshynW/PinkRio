<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;
use App\Repositories\RolesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends AdminController
{
    protected $perm_rep = false;
    protected $rol_rep = false;
    public function __construct(RolesRepository $rol_rep, PermissionRepository $perm_rep)
    {
        parent::__construct();
        $this->perm_rep = $perm_rep;
        $this->rol_rep = $rol_rep;
        $this->template = env('theme').'.admin.permission';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('EDIT_USERS'))
        {
            abort(403);
        }
        $this->title = "Редагування прав користувачыв";
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();
        $this->content = view(env('theme').".admin.permission_content")->with(array_fill_keys('permissions'=>$roles,'priv'=>$permissions));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('sss');//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('sss');//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('sss');//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('sss');//
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
        dd('sss');//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('sss');//
    }
    public function getRoles ()
    {
        $roles = $this->rol_rep->get();
        return $roles;
    }
    public function getPermissions()
    {
        $permissions = $this->perm_rep->get();
        return $permissions;
    }
}
