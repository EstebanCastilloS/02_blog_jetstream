<x-admin-layout :breadcrumb="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Permisos',
        'url' => route('admin.permissions.index'),
    ],
    [
        'name' => 'Nuevo Permiso',

    ]
]">

    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{ route('admin.permissions.store') }}" method="POST">

            @csrf

            <x-validation-errors class="mb-4"/>

            <div class="mb-4">

                <x-label class="mb-1">
                    Nombre del Permiso
                </x-label>
                <x-input class="w-full"
                    name="name"
                    placeholder="Ingrese el nombre del Permiso"
                    value="{{ old('name') }}"/>

            </div>

            <x-button class="mt-4">
                Crear Permiso
            </x-button>

        </form>

    </div>

</x-admin-layout>
