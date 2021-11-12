<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PruebaController extends Controller
{
    /**
     * Rutas para realizar pruebas y comprobaciones.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('routes_prueba');
    }

}
