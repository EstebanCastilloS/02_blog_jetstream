<x-admin-layout>
    <h2>hola desde resource-views-admin-categories-create</h2>

    {{-- crear formulario --}}
    <form action="{{ route('admin.categories.store') }}"
        method="POST" class="bg-white rounded-lg p-6 shadow-lg">
        @csrf

        <x-validation-errors class="mb-4"/>

        <div class="mb-4">

            <x-label class="mb-2 text-black">Nombre de la categoria</x-label>
            <x-input class="w-full" placeholder="Escriba nombre de la categoria" name="name" />

        </div>

        <div class="flex justify-end">
            <x-button>Crear categoria</x-button>
        </div>

    </form>

</x-admin-layout>

