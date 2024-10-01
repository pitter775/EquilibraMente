<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteDashboardController extends Controller
{
    public function index()
    {
        return view('cliente.teste');
    }
}
