<?php
namespace App\Repositories;
use App\Models\Permission;
use App\Models\Role;

class RolesRepository extends \App\Repositories\Repository
{
    public function __construct (Role $role)
    {
        $this->model = $role;
    }

}
