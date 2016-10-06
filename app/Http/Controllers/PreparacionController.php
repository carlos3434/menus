<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PreparacionController extends Controller
{
    
    public function index()
    {
        return view('pedidos.preparacion');
    }

}
