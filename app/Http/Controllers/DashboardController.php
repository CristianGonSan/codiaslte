<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Muestra el panel de control de la aplicación.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener el conteo de usuarios y productos
        $count_users = User::count();
        $count_products = Product::count();
        $count_clients = Client::count();

        // Preparar los datos para pasar a la vista
        $data = [
            'count_users' => $count_users,
            'count_products' => $count_products,
            'count_clients' => $count_clients
        ];

        // Retornar la vista 'dashboard' pasando los datos
        return view('dashboard', $data);
    }
}
