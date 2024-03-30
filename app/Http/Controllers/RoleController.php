<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create($request->all());

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Rol creado correctamente',
            'text' => 'El rol se creó con éxito',
        ]);

        return redirect()->route('admin.roles.edit', $role);


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update($request->all());

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Bien hecho',
            'text' => 'El rol se actualizó con éxito',
        ]);

        return redirect()->route('admin.roles.edit', $role);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Bien hecho',
            'text' => 'El rol se eliminó con éxito',
        ]);

        return redirect()->route('admin.roles.index');

    }
}
