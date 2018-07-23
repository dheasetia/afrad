<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $primaryKey = 'id';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function getFirstRoleLabelAttribute()
    {
        return $this->roles()->pluck('label')->first();
    }
    public function getFirstRoleIdAttribute()
    {
        return $this->roles()->pluck('id')->first();
    }

    public function getLabelStatusAttribute()
    {
        return $this->is_banned === 1 ? '<span class="label label-danger">محظور</span>' : '<span class="label label-success">نشط</span>';
    }
}
