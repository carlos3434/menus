<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //buscar los mosulos del usuario
       $submodulos= \DB::table('role_user as ru')
        ->select(
            'sub.id' , 'sub.name', 'sub.url' , 'sub.icon' , 
                'm.name as menu', 'm.url as menu_url'
        )
        ->join(
            'roles as r', 'ru.role_id', '=', 'r.id'
        )
        ->join(
            'permission_role as pr', 'r.id', '=', 'pr.role_id'
        )
        ->join(
            'permissions as p', 'pr.permission_id', '=', 'p.id'
        )
        ->join(
            'modulos as sub', 'p.modulo_id', '=', 'sub.id'
        )
        ->join(
            'modulos as m', 'sub.modulo_id', '=', 'm.id'
        )
        ->where('ru.user_id',$event->user->id)
        ->groupby('sub.id')
        ->get();
        $menu=[];
        foreach ($submodulos as $submodulo) {
            //echo $submodulo->name;
            //echo $submodulo->url;
            //echo $submodulo->icon;
            //echo $submodulo->menu;
            //echo $submodulo->menu_url;

            $modulo=$submodulo->menu;
            $sub=$submodulo->name;
            $menu[$modulo][$sub]=$submodulo;

        }
        //dd($menu);
        session(['submodulos'=>$menu]);
/*
        if (session()->has('submodulos')) {
            $value = session('submodulos');
            dd($value);
        }*/
    }
}
