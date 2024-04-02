<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,$user->id",
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'nullable|array',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->password) {
            $user->password = bcrypt($request->password);
        }

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Usuario actualizado correctamente',
            'text' => 'El usuario se actualizó con éxito',
        ]);

        $user->save();
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.edit', $user);
    }

    public function destroy(User $user)
    {
        //
    }
}
