<div class="flex flex-col gap-4 items-center">
    <span class="text-xl font-semibold text-gray-500 dark:text-gray-400">Comments</span>
    @if($Comments->count() == 0)
        <p>No comments yet.</p>
    @else
        @foreach($Comments as $comment)
            <div class="card bg-base-100 shadow-xl max-w-md w-full mx-auto">
                <div class="card-body">
                    <div class="font-semibold flex w-full justify-between">
                        <span>{{ $comment->user->name }}</span>

                        @if(auth()->check() && $comment->user->id == auth()->user()->id)
                            <button wire:confirm="Are you sure you want to delete this comment?"
                                    wire:click="deleteComment({{ $comment->id }})"
                                    class="btn btn-square btn-sm btn-error">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                     stroke="white">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $comment->created_at->format('d.m.Y @ H:i') }}
                    </p>
                    <p>{{ $comment->content }}</p>
                </div>
            </div>
        @endforeach
    @endif

    @if(auth()->check())
        <form wire:submit.prevent="addComment" class="flex flex-col gap-4 max-w-xs w-full mx-auto">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Add a comment</span>
                </div>
                <textarea placeholder="Type here" wire:model.defer="commentContent"
                          class="textarea textarea-bordered"></textarea>
            </label>
            <button type="submit" class="btn btn-neutral btn-sm">Add Comment</button>
        </form>
    @else
        <p>You need to be logged in to add a comment.</p>
        <a href="{{ route('login') }}" class="text-xl font-semibold text-black dark:text-white">Login now</a>
    @endif
</div>
