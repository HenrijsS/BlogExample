<div class="card mx-auto bg-base-100 shadow-xl max-w-sm w-full">
    <div class="card-body items-center">
        <h1 class="card-title">Login</h1>
        <form wire:submit.prevent="login" class="flex flex-col max-w-xs w-full my-4">
            {{--        E-Mail--}}
            <div class="flex flex-col">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Email</span>
                    </div>
                    <input type="email" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                           wire:model.defer="email" required/>
                </label>
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{--        Password--}}
            <div class="flex flex-col">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Password</span>
                    </div>
                    <input type="password" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                           wire:model.defer="password" required/>
                </label>
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            @if (session()->has('error'))
                <div class="alert alert-error w-full mx-auto py-2 text-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex items-center justify-center">
                <button type="submit"
                        class="btn btn-primary">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
