<x-admin-layout :breadcrumb="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Uusarios',
        'url' => route('admin.roles.index'),
    ],
    [
        'name' => $user->name,

    ]
]">

    <div class="bg-white rounded shadow-lg p-6">

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-label>
                    Nombre del Usuario
                </x-label>
                <x-input
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="block mt-1 w-full"
                    autofocus/>
            </div>

            <div class="mb-4">
                <x-label>
                    Email del Usuario
                </x-label>
                <x-input
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    class="block mt-1 w-full"/>
            </div>

            {{-- password --}}
            <div class="mb-4">
                <x-label>
                    Password del Usuario
                </x-label>
                <x-input
                    name="password"
                    type="password"
                    class="block mt-1 w-full"/>
            </div>

            {{-- confirma password --}}
            <div class="mb-4">
                <x-label>
                    Confirmar Password del Usuario
                </x-label>
                <x-input
                    name="password_confirmation"
                    type="password"
                    class="block mt-1 w-full"/>
            </div>

            <div class="mb-4">
                <x-label>
                    Roles del Usuario
                </x-label>

                <ul>
                    @foreach ($roles as $role)
                        <li>
                            <label>
                                <x-checkbox
                                    name="roles[]"
                                    value="{{ $role->id }}"
                                    :checked="in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()))"/>
                                {{ $role->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>

            </div>

            <div class="flex justify-end">
                <x-button>
                    Actualizar Usuario
                </x-button>

                {{-- <x-danger-button class="ml-2" onclick="deleteUser()">
                    Eliminar
                </x-danger-button> --}}
            </div>
        </form>

    </div>
</x-admin-layout>
