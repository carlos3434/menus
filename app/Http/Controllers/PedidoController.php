<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PedidoController extends Controller
{
    
    public function index()
    {
        return view('pedidos.atencion');
    }
    public function getPreparacion()
    {
        return view('pedidos.atencion');
    }

}
