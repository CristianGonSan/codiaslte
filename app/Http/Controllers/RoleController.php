<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show', compact('role'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente.');
    }

    public function edit($id)
    {
        $role = Role::findById($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findById($id);
        $role->name = $request->name;

        $role->save();
        return redirect()->route('roles.show', $role->id)
            ->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado exitosamente.');
    }

    public function editPermissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.edit-permissions', compact('role', 'permissions'));
    }

    public function updatePermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permissions);

        return redirect()->back()
            ->with('success', 'Permisos actualizados exitosamente.');
    }

    public function dataTable(): JsonResponse
    {
        try {
            return DataTables::of(Role::query())
                ->editColumn('created_at', function ($role) {
                    return $role->created_at->format('Y/m/d H:i:s');
                })->addColumn('action', function ($role) {
                    return '<a href="' . route('roles.show', $role->id) . '" class="btn btn-sm btn-outline-primary mr-1"><i class="far fa-eye"></i></a>';
                })
                ->rawColumns(['action'])
                ->make();
        } catch (Exception $e) {
            Log::error('Error en RoleController@datatable: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al cargar los datos de los roles.'], 500);
        }
    }
}

