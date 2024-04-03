<x-admin-layout :breadcrumb="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Artículos',
        'url' => route('admin.posts.index'),
    ],
    [
        'name' => $post->title,

    ]
]">
    <h1>hola desde edit de Posts</h1>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @endpush

    <form action="{{ route('admin.posts.update', $post) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <x-validation-errors class="mb-4" />

        {{-- imagen --}}
        <div class="mb-6 relative">
            <figure>
                <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $post->image }}" alt=""
                    id="imgPreview">
            </figure>

            <div class="absolute top-8 right-8">
                <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">

                    <i class="fa-solid fa-camera mr-2"></i>
                    Actualizar Imagen
                    <input type="file" accept="image/*" name="image" class="hidden"
                        onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>
        </div>

        {{-- Título del Artículo --}}
        <div class="mb-4">
            <x-label class="mb-2">
                Título del Artículo
            </x-label>
            <x-input name="title" value="{{ old('title', $post->title) }}" class="w-full"
                placeholder="Ingrese el nombre del artículo" />
        </div>

        {{-- Contenido del Slug --}}
        <div class="mb-4">
            <x-label class="mb-2">
                Contenido del Slug
            </x-label>
            <x-input name="slug" value="{{ old('slug', $post->slug) }}" class="w-full"
                placeholder="Ingrese el contenido del Slug" />
        </div>

        {{-- Extracto del Artículo --}}
        <div class="mb-4">
            <x-label class="mb-2 ">
                Extracto del Artículo
            </x-label>
            <x-textarea name="excerpt"   class="w-full" placeholder="Ingrese el extracto del artículo">
                {{ old('excerpt', $post->excerpt) }}
            </x-textarea>
        </div>

        {{-- Etiquetas --}}
        {{-- <div class="mb-4">
            <x-label class="mb-2 ">
                Etiquetas
            </x-label>
            <select class="tag-multiple" name="tags[]" multiple="multiple" style="width: 100%">

                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </option>

                @endforeach

            </select>
        </div> --}}

        {{-- Etiquetas --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Etiquetas
            </x-label>

            <select class="select2" name="tags[]" multiple="multiple" style="width: 100%">

                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                        @selected(collect(old('tags', $post->tags->pluck('id')))->contains($tag->id))>
                        {{ $tag->name }}
                    </option>
                @endforeach

            </select>


        </div>

        {{-- Contenido del Artículo --}}
        <div class="mb-4">
            <x-label class="mb-2 ">
                Contenido del Artículo
            </x-label>
            <div class="ckeditor">
                <x-textarea name="body"
                    class="w-full"
                    id="editor"
                    placeholder="Ingrese el contenido del artículo"
                    rows="8">
                    {{ old('body', $post->body) }}
                </x-textarea>
            </div>
        </div>

        {{-- Estado del Artículo --}}
        {{-- <div class="mb-4">
            <x-label class="mb-2 ">
                Estado del Artículo
            </x-label>
            <x-select name="published" class="w-full">

                @if ($post->published == 0)
                    <option value="0">No Publicado</option>
                    <option value="1">Publicado</option>
                @else
                    <option value="1">Publicado</option>
                    <option value="0">No Publicado</option>
                @endif

            </x-select>
        </div> --}}

        {{-- Estado del Artículo --}}
        {{-- <div class="mb-4">
            <x-label class="mb-2 ">
                Estado del Artículo
            </x-label>
            <x-select name="published" class="w-full">
                @foreach ($post as $postPublished)
                    <option @selected(old('published', $postPublished->published) == $posts->id)
                        value="{{ $posts->id }}">
                        {{ $posts->published }}
                    </option>
                @endforeach
            </x-select>
        </div> --}}

        {{-- Categorías --}}
        <div class="mb-4">
            <x-label class="mb-2 ">
                Categorías
            </x-label>
            <x-select name="category_id" class="w-full">
                @foreach ($categories as $category)
                    <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>
        </div>

        {{-- Usuarios --}}
        <div class="mb-4">
            <x-label class="mb-2 ">
                Usuarios
            </x-label>
            <x-select name="user_id" class="w-full">
                @foreach ($users as $user)
                    <option @selected(old('user_id', $post->user_id) == $user->id) value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </x-select>
        </div>

        {{-- Estado publicar --}}
        <div class="mb-4">

            <input type="hidden" name="published" value="0">

            <label class="relative inline-flex items-center cursor-pointer">
                <input name="published" type="checkbox" value="1" class="sr-only peer"
                    @checked(old('published', $post->published) == 1)>
                <div
                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-900">Publicar</span>
            </label>

        </div>

        <div class="flex justify-end">

            <x-danger-button class="mr-2" onclick="deletePost()">
                Eliminar Artículo
            </x-danger-button>
            <x-button class="ml-4">
                Actualizar Artículo
            </x-button>
        </div>
    </form>

    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>


        <script>
            function deletePost() {
                let form = document.getElementById('formDelete');
                form.submit();
            }
        </script>

        <script>
            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                const input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                file = input.files[0];

                //Creamos la url
                objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;

            }
        </script>

        {{-- Agregamos el script de ckeditor5 --}}
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    simpleUpload: {
                        // The URL that the images are uploaded to.
                        uploadUrl: "{{ route('images.upload') }}",

                        // Enable the XMLHttpRequest.withCredentials property.
                        withCredentials: true,

                        // Headers sent along with the XMLHttpRequest to the upload server.
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                        }
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>


    @endpush

</x-admin-layout>
