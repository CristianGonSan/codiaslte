<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Log;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    // Mostrar la lista de usuarios
    public function index()
    {
        return view('users.index');
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Almacenar un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    // Mostrar el formulario para editar un usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('users.show', $user->id)
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit-password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.show', $user->id)
            ->with('success', 'Contraseña actualizada exitosamente.');
    }

    public function editRoles($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit-roles', compact('user', 'roles'));
    }

    public function updateRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request->roles);

        return redirect()->back()
            ->with('success', 'Roles actualizados exitosamente.');
    }

    public function profile()
    {
        return view('users.profile');
    }

    public function enable($id)
    {
        $user = User::findOrFail($id);
        $user->enabled = true;
        $user->save();

        return redirect()->back()->with('success', 'Usuario activado exitosamente.');
    }

    public function disable($id)
    {
        $user = User::findOrFail($id);
        $user->enabled = false;
        $user->save();

        return redirect()->back()->with('success', 'Usuario desactivado exitosamente.');
    }

    public function dataTable()
    {
        try {
            return DataTables::of(User::query())
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('Y/m/d H:i:s');
                })
                ->addColumn('enabled', function ($user) {
                    return $user->enabled ? 'Si' : 'No';
                })
                ->addColumn('verified', function ($user) {
                    return $user->hasVerifiedEmail() ? 'Si' : 'No';
                })
                ->addColumn('action', function ($user) {
                    return '<a href="' . route('users.show', $user->id) . '" class="btn btn-sm btn-outline-primary mr-1"><i class="far fa-eye"></i></a>';
                })
                ->rawColumns(['enabled', 'verified', 'action'])
                ->make();
        } catch (Exception $e) {
            Log::error('Error en UserController@datatable: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al cargar los datos de los usuarios.'], 500);
        }
    }

}
