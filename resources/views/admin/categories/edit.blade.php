<x-admin-layout>
    <h2>hola desde resource-views-admin-categories-edit</h2>

    {{-- crear formulario --}}
    <form action="{{ route('admin.categories.update', $category) }}"
        method="POST"
        class="bg-white rounded-lg p-6 shadow-lg">

        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4" />

        <div class="mb-4">

            <x-label class="mb-2">
                Nombre de la categoria
            </x-label>
            <x-input
                class="w-full"
                placeholder="Escriba nombre de la categoria"
                name="name"
                value="{{ $category->name }}" />

        </div>

        <div class="flex justify-end">

            <x-button>Actualizar categoria</x-button>
        </div>

    </form>

</x-admin-layout>



