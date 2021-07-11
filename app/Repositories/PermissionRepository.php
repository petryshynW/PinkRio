<?php
namespace App\Repositories;
use App\Models\Permission;
class PermissionRepository extends \App\Repositories\Repository
{
    public function __construct (Permission $permission)
    {
        $this->model = $permission;
    }

}
