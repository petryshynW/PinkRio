<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    use HasFactory;
    public function users()
    {
        return $this->belongsToMany('App\Models\User','role_user');
    }
    public function permission ()
    {
        return $this->belongsToMany('App\Models\Permission','permission_role');
    }
    public function hasPermission($name,$require = false)
    {
        if (is_array($name))
        {
            foreach ($name as $permName)
            {
                $permName = $this->hasPermission($permName);
                if ($permName && !$require)
                {
                    return true;
                }
                else if (!$permName && $require)
                {
                    return false;
                }
            }
            //dd ($require);
            return $require;
        }
        else
        {
            foreach ($this->permission()->get() as $perm)
            {
                if ($perm->name == $name)
                {
                    return true;
                }
            }

        }
    }
    public function savePermission ($inputPerms)
    {
        if (!empty($inputPerms))
        {
            $this->permission()->sync($inputPerms);
        }
        else
        {
            $this->permission()->detach();
        }
        return true;
    }
}
