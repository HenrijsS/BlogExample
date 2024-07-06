<div class="flex flex-col gap-8 max-w-3xl mx-auto w-full [&>*]:w-full">

    <div class="card bg-base-100 shadow-xl max-w-3xl w-full mx-auto">
        <div class="card-body">
            <label class="input input-bordered flex items-center gap-2">
                <input type="text" class="grow" placeholder="Search" wire:model.live.debounce="search"/>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path
                        fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd"/>
                </svg>
            </label>

            @if ($searchedPosts)
                <div class="flex flex-col gap-4 mt-4">
                    @foreach ($searchedPosts as $post)
                        <a href="{{ route('post', $post->id) }}"
                           class="card bg-neutral text-neutral-content shadow-xl max-w-3xl w-full mx-auto">
                            <div class="card-body">
                                <div class="flex justify-between w-full items-center">
                                    <h2 class="card-title">{{ $post->title }}</h2>

                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $post->created_at->format('d.m.Y @ H:i') . ' by ' . $post->user->name }}
                                    </span>
                                </div>
                                <p>{{ strip_tags($post->excerpt) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl max-w-3xl w-full mx-auto">
        <div class="card-body">
            <h2 class="card-title">
                Categories
            </h2>

            <ul class="menu menu-vertical lg:menu-horizontal bg-base-200 rounded-box gap-2">
                <li>
                    <div
                        wire:click="$set('currentCategory', null)"
                        class=" {{ $currentCategory == null ? 'active' : '' }}">
                        All
                    </div>
                </li>
                @foreach ($categories as $category)
                    <li>
                        <div wire:click="$set('currentCategory', '{{ $category->id }}')"
                             class="{{ $category->id == $currentCategory ? 'active' : '' }}">
                            {{ $category->name }} ({{ $category->posts->count() }})
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

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
                    @foreach ($post->categories as $category)
                        <a href="{{ '/blog/' . $category->name }}"
                           class="link-info">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </p>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $post->created_at->format('d.m.Y @ H:i') . ' by ' . $post->user->name }}
                </p>
                <p>{{ strip_tags($post->excerpt) }}</p>

                <div class="flex justify-end gap-4 mt-4">
                    @can('edit', $post)
                        <a href="{{ route('dashboard.post.edit', $post->id) }}"
                           class="btn btn-neutral">
                            Edit Post
                        </a>
                    @endcan

                    <a href="{{ route('post', $post->id) }}"
                       class="btn btn-primary">
                        Read More
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
</div>
