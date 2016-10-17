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
    	["valor" => "Disponible", "color" => "#00a65a"],
    	["valor" => "reservada", "color" => "#f39c12"],
    	["valor" => "Ocupada", "color" => "#dd4b39"],
    	["valor" => "No Disponible", "color" => "#ddd"]
    	];

    	$productos = [
    		"menu" => [
    			["id" => 1,
    			"descripcion_corta" => "Sopa + Pollo Saltado",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M" ],

    		    ["id" => 2,
    		    "descripcion_corta" => "Sopa + Aji de Gallina",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ],

    		    ["id" => 3,
    		    "descripcion_corta" => "Causa de Pollo + Seco con Frejoles",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ],

    		    ["id" => 4,
    		    "descripcion_corta" => "Cebiche + Arroz con Pollo",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ],

    		    ["id" => 5,
    		    "descripcion_corta" => "Causa de Pollo + Adobo de Carne",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ],

    		    ["id" => 6,
    		    "descripcion_corta" => "Sopa + Picante de Carne",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "M"  ]
			],

			"carta" => [
    			["id" => 7,
    			"descripcion_corta" => "Arroz Chaufa Mixto",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "C" ],

    		    ["id" => 8,
    		    "descripcion_corta" => "Bisteck a lo Pobre",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "C"  ],

    		    ["id" => 9,
    		    "descripcion_corta" => "Parihuela",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "C"  ],

    		    ["id" => 10,
    		    "descripcion_corta" => "Pollo Apanado",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "C"  ],

    		    ["id" => 11,
    		    "descripcion_corta" => "Lomo Saltado",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "C"  ],

    		    ["id" => 12,
    		    "descripcion_corta" => "Sopa a la Minuta",
    		    "preparacion" => "Esta es una descripcion de preparacion",
    		    "stock" => 50,
    		    "tipo" => "C"  ]
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
