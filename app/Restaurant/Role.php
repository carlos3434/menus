<?php namespace Restaurant;
 
use Zizaco\Entrust\EntrustRole;
 
class Role extends EntrustRole
{
   protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
    public function permissions() {
        //return $this->belongsToMany('Modules\User\Entities\Permission', 'permission_role');
        return $this->belongsToMany('Restaurant\Permission', 'permission_role');
    }
   //establecemos las relacion de muchos a muchos con el modelo User, ya que un rol 
   //lo pueden tener varios usuarios y un usuario puede tener varios roles
   public function users(){
        return $this->belongsToMany('Restaurant\User');
    }
}