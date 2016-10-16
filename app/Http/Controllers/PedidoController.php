<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PedidoController extends Controller
{
    
    public function index()
    {	
    	$estados = [
    	["valor" => "disponible", "color" => "#00a65a"],
    	["valor" => "reservada", "color" => "#f39c12"],
    	["valor" => "ocupada", "color" => "#dd4b39"],
    	["valor" => "no disponible", "color" => "#ddd"]
    	];

    	$productos = [
    		"menu" => [
    			["descripcion_corta" => "Sopa + Pollo Saltado",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M" ],

    		    ["descripcion_corta" => "Sopa + Aji de Gallina",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ],

    		    ["descripcion_corta" => "Causa de Pollo + Seco con Frejoles",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ],

    		    ["descripcion_corta" => "Cebiche + Arroz con Pollo",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ],

    		    ["descripcion_corta" => "Causa de Pollo + Adobo de Carne",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ],

    		    ["descripcion_corta" => "Sopa + Picante de Carne",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ]

    				 ],

    	];
    	
    	$mesas = [];
    	for ($i = 0; $i < 50; $i++) {
    		$p = (int)rand(0, 3);
    		$numasientos = rand(2, 8);
    		if (isset($estados[$p])) {
    			$mesas[] = ["nombre" => "MESA-".$i,
    						"estado" => $estados[$p],
    						"numasientos" => $numasientos];
    		}
    	}
    	$data = ["estados" => $estados, "mesas" => $mesas, "productos" => $productos];
        return view('pedidos.atencionv1', $data);
        //return view('pedidos.atencion');
    }
    public function getPreparacion()
    {
        return view('pedidos.atencion');
    }


}
