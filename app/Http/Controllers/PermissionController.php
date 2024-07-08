<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permissions.index');
    }

    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.show', compact('permission'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permiso creado correctamente.');
    }

    public function edit($id)
    {
        $permission = Permission::findById($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findById($id);

        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')
            ->with('success', 'Permiso actualizado correctamente.');
    }

    public function destroy($id)
    {
        $permission = Permission::findById($id);
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permiso eliminado correctamente.');
    }

    public function dataTable(): JsonResponse
    {
        try {
            return DataTables::of(Permission::query())
                ->editColumn('created_at', function ($permission) {
                    return $permission->created_at->format('Y/m/d H:i:s');
                })->addColumn('action', function ($permission) {
                    return '<a href="' . route('permissions.show', $permission->id) . '" class="btn btn-sm btn-outline-primary mr-1"><i class="far fa-eye"></i></a>';
                })
                ->rawColumns(['action'])
                ->make();
        } catch (Exception $e) {
            Log::error('Error en PermissionController@datatable: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al cargar los datos de los permisos.'], 500);
        }
    }
}

