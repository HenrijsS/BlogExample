<x-layout title="My Posts">
    <h1 class="text-3xl font-semibold text-black w-full text-center">My Posts</h1>

    <div class="flex justify-center gap-4 my-4">
        <a href="{{ route('dashboard.post.create') }}" class="btn btn-primary">
            Create a new post
        </a>
    </div>

    <div class="flex flex-col gap-8">
        @if (count($posts) === 0)
            <p class="text-xl text-gray-500 dark:text-gray-400">
                You haven't created any posts yet.
            </p>
        @endif
        @foreach ($posts as $index => $post)
            <div class="card lg:card-side bg-base-100 shadow-xl max-w-3xl w-full mx-auto">
                <figure class="flex-shrink-0 w-1/3">
                    <img
                        src="{{ asset('/images/placeholder.png') }}"
                        class="object-cover w-full h-full"
                        alt="Album"/>
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $post->created_at->format('d.m.Y @ H:i') . ' by ' . $post->user->name }}
                    </p>
                    <p>{{ strip_tags($post->excerpt) }}</p>

                    <div class="flex justify-end gap-4 mt-4">
                        <a href="{{ route('dashboard.post.edit', $post->id) }}"
                           class="btn btn-neutral">
                            Edit Post
                        </a>

                        <a href="{{ route('post', $post->id) }}"
                           class="btn btn-primary">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
