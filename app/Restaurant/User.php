<?php

namespace Restaurant;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Carbon\Carbon;

class User extends Authenticatable
{
     use EntrustUserTrait; //hacemos uso del trait en la clase User para hacer uso de sus métodos
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','phone_number','birthdate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //establecemos las relaciones con el modelo Role, ya que un usuario puede tener varios roles
    //y un rol lo pueden tener varios usuarios
    public function roles(){
        return $this->belongsToMany('Restaurant\Role');
    }

    public function getFullNameAttribute()
    {

        return $this->first_name .' '. $this->last_name;
    }

    public function getCreatedAtAttribute($attr)
    {

        return Carbon::parse($attr)->toFormattedDateString(); //Change the format to whichever you desire
    }

}
