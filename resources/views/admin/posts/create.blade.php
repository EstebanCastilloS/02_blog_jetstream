<x-admin-layout>
    <h1>hola desde create de Posts</h1>

    <h1 class="text-3x1 font-semibold mb-2">Nuevo Artículo</h1>

    <form action="{{ route('admin.posts.store') }}"
            method="POST"
            x-data="data()"
            x-init="$watch('title', value =>{ string_to_slug(value)})">
            {{--  --}}

        @csrf

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Título del Artículo
            </x-label>
            <x-input
            name="title"
            value="{{ old('title') }}"
            x-model="title"
            class="w-full"
            placeholder="Ingrese el nombre del artículo"/>
        </div>

        <div class="mb-4">
            <x-label class="mb-2 ">
                Contenido del Slug
            </x-label>
            <x-input
            name="slug"
            value="{{ old('slug') }}"
            x-model="slug"
            class="w-full"
            placeholder="Ingrese el contenido del Slug"/>
        </div>

        <div class="mb-4">
            <x-label class="mb-2 ">
                Extracto del Artículo
            </x-label>
            <x-textarea
                value="{{ old('excerpt') }}"
                name="excerpt"
                class="w-full"
                placeholder="Ingrese el extracto del artículo">
            </x-textarea>
        </div>

        <div class="mb-4">
            <x-label class="mb-2 ">
                Contenido del Artículo
            </x-label>
            <x-textarea
                value="{{ old('body') }}"
                name="body"
                class="w-full"
                placeholder="Ingrese el contenido del artículo">
            </x-textarea>
        </div>

        <div class="mb-4">
            <x-label class="mb-2 ">
                Estado del Artículo
            </x-label>
            <x-select name="published" class="w-full">
                <option value="">Seleccionar Estado</option>
                <option value="0">Borrador</option>
                <option value="1">Publicado</option>
            </x-select>
        </div>

        <div class="mb-4">
            <x-label class="mb-2 ">
                Categorías
            </x-label>
            <x-select name="category_id" class="w-full">
                @foreach ($categories as $category)
                    <option @selected(old('category_id') == $category->id)
                        value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>
        </div>

        {{-- <div class="mb-4">
            <x-label class="mb-2 ">
                Usuarios
            </x-label>
            <x-select name="user_id" class="w-full" >
                @foreach ($users as $user)
                    <option @selected(old('user_id') == $user->id)
                        value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </x-select>
        </div> --}}

        <div class="flex justify-end">
            <x-button class="ml-4">
                Crear Artículo
            </x-button>
        </div>
    </form>

    @push('js')
        <script>
            function data(){
                return {
                    title: '',
                    slug: '',
                    string_to_slug(str){
                        str = str.replace(/^\s+|\s+$/g, '');
                        str = str.toLowerCase();
                        var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                        var to = "aaaaeeeeiiiioooouuuunc------";
                        for (var i = 0, l = from.length; i < l; i++) {
                            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                        }
                        str = str.replace(/[^a-z0-9 -]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-');
                        this.slug = str;
                    }
                }
            }
        </script>
    @endpush

</x-admin-layout>

