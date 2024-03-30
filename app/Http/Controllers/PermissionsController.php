<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{

    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create($request->all());

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Permiso creado correctamente',
            'text' => 'El permiso se creó con éxito',
        ]);

        return redirect()->route('admin.permissions.edit', $permission);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($request->all());

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Permiso actualizado correctamente',
            'text' => 'El permiso se actualizó con éxito',
        ]);

        return redirect()->route('admin.permissions.edit', $permission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Permiso eliminado correctamente',
            'text' => 'El permiso se eliminó con éxito',
        ]);

        return redirect()->route('admin.permissions.index');
    }
}
