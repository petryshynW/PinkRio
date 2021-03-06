<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'view_name',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function articles ()
    {
        return $this->hasMany('App\Models\Article');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','role_user');
    }
    public function canDo($permission,$require = false)
    {
        if (is_array($permission))
        {
            foreach ($permission as $permName)
            {
                $permName = $this->canDo($permName);
                if ($permName && !$require)
                {
                    return true;
                }
                else if (!$permName && $require)
                {
                    return false;
                }
            }
            return $require;
        }
        else
        {

            foreach ($this->roles()->get() as $role)
            {
                foreach ($role->permission()->get() as $perm)
                {
                    if (Str::is($permission, $perm->name))
                    {
                        return true;
                    }
                }
            }
        }
    }

}
