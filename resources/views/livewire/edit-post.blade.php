<div class="card mx-auto bg-base-100 shadow-xl max-w-5xl w-full">

    <div class="card-body items-center">

        <h1 class="card-title">{{ $title ? 'Edit Post' : 'Create a new Blog Post' }}</h1>

        <div class="flex w-full justify-end">
            <button wire:confirm="Are you sure you want to delete this post?"
                    wire:click="deletePost"
                    class="btn btn-sm btn-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                     stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>

                <span class="ml-2 text-white">Delete Post</span>
            </button>
        </div>

        <form wire:submit.prevent="save" class="flex flex-col w-full my-4">

            {{--Title --}}
            <div class="flex flex-col mb-4">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Title</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full"
                           wire:model.defer="title" required/>
                </label>
                @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{--Content--}}
            <div class="flex flex-col mb-4" wire:ignore>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Content</span>
                    </div>
                    <textarea id="content" class="tinyMCE" name="content" wire:model.defer="content"></textarea>
                </label>
                @error('content')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

            </div>

            {{--Categories--}}
            <div class="flex flex-col mb-4">
                <label for="categories">Categories</label>
                {{-- Select multiple with checkboxes (NOT SELECT) --}}
                @foreach ($categories as $category)
                    <div class="flex items-center gap-4">
                        <div class="form-control">
                            <label class="label cursor-pointer flex items-center gap-2">
                                <input type="checkbox" name="categories[{{ $category->id }}]"
                                       value="{{ $category->id }}"
                                       wire:model.defer="selectedCategories"
                                       class="checkbox">
                                <span class="label-text">{{ $category->name }}</span>
                            </label>
                        </div>
                    </div>
                @endforeach
                @error('categories')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            @if (session()->has('error'))
                <div class="text-red-500 text-sm mb-4">{{ session('error') }}</div>
            @endif

            <div class="flex items-center justify-center">
                <button type="submit" class="btn btn-primary">
                    {{ $isEdit ? 'Update Post' : 'Publish new post' }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    {{--Change to onLoad--}}
        window.onload = function () {
        tinymce.init({
            selector: 'textarea.tinyMCE',
            license_key: 'gpl',

            /* TinyMCE configuration options */
            skin: false,
            content_css: false,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.
                    set('content', editor.getContent());
                });
            },
        });
    };
</script>
