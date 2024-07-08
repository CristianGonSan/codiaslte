<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Log;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index');
    }

    public function create()
    {
        // Mostrar el formulario para crear un nuevo cliente
        return view('clients.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        // Crear un nuevo cliente
        Client::create($request->all());

        // Redireccionar a la vista de todos los clientes
        return redirect()->route('clients.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    public function show($id)
    {
        // Mostrar los detalles de un cliente específico
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    public function edit($id)
    {
        // Mostrar el formulario para editar un cliente
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $client = Client::findOrFail($id);

        // Actualizar los datos del cliente
        $client->update($request->all());

        // Redireccionar a la vista de detalles del cliente
        return redirect()->route('clients.show', $client->id)
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        // Eliminar el cliente
        $client->delete();

        // Redireccionar a la vista de todos los clientes
        return redirect()->route('clients.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }

    public function dataTable()
    {
        try {
            return DataTables::of(Client::query())
                ->editColumn('created_at', function ($client) {
                    return $client->created_at->format('Y/m/d H:i:s');
                })
                ->addColumn('action', function ($client) {
                    return '<a href="' . route('clients.show', $client->id) . '" class="btn btn-sm btn-outline-primary mr-1"><i class="far fa-eye"></i></a>';
                })
                ->make();
        } catch (Exception $e) {
            // Manejo de errores más adecuado
            Log::error('Error en ProductController@dataTable: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al cargar los datos de los productos.'], 500);
        }
    }
}
