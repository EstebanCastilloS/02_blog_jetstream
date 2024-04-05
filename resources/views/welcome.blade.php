<x-app-layout>

    {{-- recuperar imagen de la carpeta public --}}
    <figure class="mb-12">
        <img src="{{ asset('img/home/negocios.png') }}"
        alt="Portada del Home"
        class="w-full aspect-[3/1] object-cover object-center">
    </figure>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <h1 class="text-7xl text-center font-semibold text-black mb-6">
            Lista de Artículos
        </h1>

        <div class="space-y-8">
            @foreach ($posts as $post)

                <article class="grid grid-cols-2 gap-6">

                    <figure>
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" >

                    </figure>

                    <div>
                        <h1 class="text-3xl font-semibold text-black">
                            {{ $post->title }}
                        </h1>
                        <hr class="mt-1 mb-2">
                        <div class="mb-2">
                            @foreach ($post->tags as $tag)
                                <span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>

                        <p class="text-black mb-2">
                            {{ $post->published_at->format('d M Y') }}
                        </p>

                        <div class="text-black mb-4">
                            {{ Str::limit($post->excerpt, 100) }}
                        </div>

                        {{--  --}}
                        <div>
                            <a href="{{ route('posts.show', $post) }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Leer más
                            </a>
                        </div>



                    </div>

                </article>

            @endforeach
        </div>

        <div class="mt-8 text-white">
            {{ $posts->links() }}
        </div>

    </section>


</x-app-layout>
