<?php
namespace Restaurant;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{

    public $fillable = ['name','icon','url','modulo_id'];

    /**
     * Permission relationship
     */
    public function permission()
    {
        return $this->hasMany('Restaurant\Permission');
    }
    public function modulo()
    {
        return $this->hasMany('Restaurant\Modulo','modulo_id','id');
    }
}