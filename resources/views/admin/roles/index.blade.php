<x-admin-layout :breadcrumb="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',

    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.roles.create') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            Nuevo
        </a>
    </x-slot>

    <div class="flex justify-end mb-2">

    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Botones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $rol)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $rol->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $rol->name }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.roles.edit', $rol) }}" class="Editar">Editar</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</x-admin-layout>
