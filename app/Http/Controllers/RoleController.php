<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
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
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $role = Role::create($request->all());

        //attach() agrega los permisos que se le pasan por parámetro
        //al rol
        $role->permissions()->attach($request->permissions);

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Rol creado correctamente',
            'text' => 'El rol se creó con éxito',
        ]);

        return redirect()->route('admin.roles.edit', $role);

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
        ]);

        $role->update($request->all());

        //sinchronize() sincroniza los permisos que se le pasan por parámetro
        //con los que ya tiene el rol
        $role->permissions()->sync($request->permissions);

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
