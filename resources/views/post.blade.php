<x-layout title="{{ $post->title }}">
    <div class="card bg-base-100 shadow-xl max-w-5xl w-full mx-auto">
        <div class="card-body">
            <h1 class="card-title text-3xl font-semibold text-black w-full text-center justify-center">
                {{ $post->title }}
            </h1>

            {{--Date and Author--}}
            <div class="flex justify-between items-center mx-auto">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $post->created_at->format('d.m.Y @ H:i') }} By {{ $post->user->name }}
                </p>
            </div>

            @can('edit', $post)
                <div class="flex justify-end gap-4">
                    <a href="{{ route('dashboard.post.edit', $post->id) }}"
                       class="btn btn-neutral btn-sm">
                        Edit Post
                    </a>
                </div>
            @endcan

            <div class="flex flex-col gap-4">
                <p class="text-xl text-gray-500 dark:text-gray-400">
                    {!! $post->content !!}
                </p>
            </div>

            <livewire:comments :post-id="$post->id"/>

        </div>
    </div>
</x-layout>
