<x-app-layout>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-4">
            @foreach ($post->tags as $tag)
                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>

        <h1 class="text-black text-4xl font-semibold">
            {{ $post->title }}
        </h1>
        <hr class="mt-1 mb-2">

        <p class="text-black  mb-6">
            {{ $post->published_at->format('d M Y') }} - {{ $post->user->name }}
        </p>

        <figure class="mb-6">
            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full aspect-[16/9] object-cover object-center">
        </figure>

        <div class="text-black">
            {!! $post->body !!}
        </div>

    </section>
</x-app-layout>
