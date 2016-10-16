<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PedidoController extends Controller
{
    
    public function index()
    {	
    	$estados = [0=> ["valor" => "disponible", "color" => "#00a65a"],
    	1=>["valor" => "reservada", "color" => "#f39c12"],
    	2 => ["valor" => "ocupada", "color" => "#dd4b39",
    	3 => ["valor" => "no disponible", "color" => "#ddd"]
    	];
    	
    	$mesas = [];
    	for ($i = 0; $i < 50; $i++) {
    		$p = rand(0, 3);
    		$numasientos = rand(2, 8);
    		if (isset($estados[$i])) {
    			$mesas[] = ["nombre" => "MESA-".$i,
    						"estado" => $estados[$i],
    						"numasientos" => $numasientos];
    		}
    	}
    	$data = ["estados" => $estados, "mesas" => $mesas];
        return view('pedidos.atencionv1');
        //return view('pedidos.atencion');
    }
    public function getPreparacion()
    {
        return view('pedidos.atencion');
    }


}
