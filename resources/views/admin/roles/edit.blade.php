<x-admin-layout>

    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{ route('admin.roles.update', $role) }}" method="POST">

            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4"/>

            <div class="mb-4">

                <x-label class="mb-1">
                    Nombre del Rol
                </x-label>
                <x-input class="w-full"
                    name="name"
                    placeholder="Ingrese el nombre del rol"
                    value="{{ old('name', $role->name) }}"/>

            </div>

            <div class="flex">
                <x-button >
                    Actualizar Rol
                </x-button>

                <x-danger-button class="ml-2" onclick="deleteRole()">
                    Eliminar
                </x-danger-button>
            </div>

        </form>

        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" id="formDelete">
            @csrf
            @method('DELETE')
        </form>


    </div>

    @push('js')
        <script>
            function deleteRole(){
                let form = document.getElementById('formDelete');
                form.submit();
            }
        </script>
    @endpush

</x-admin-layout>

