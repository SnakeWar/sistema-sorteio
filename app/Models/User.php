<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function hasAnyRoles($roles)
    {
        $result = false;

        if(is_array($roles) || is_object($roles)){
            foreach($roles as $role)
            {
                if($this->roles->contains('title', $role->title)) {
                    $result = true;
                };
            }
        }

        return $result;
    }
}
