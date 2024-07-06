<div class="card mx-auto bg-base-100 shadow-xl max-w-sm w-full">
    <div class="card-body items-center">
        <h1 class="card-title">Register</h1>
        <form wire:submit.prevent="register" class="flex flex-col max-w-xs w-full my-4">
            {{-- Name --}}
            <div class="flex flex-col">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Name</span>
                    </div>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                           wire:model.defer="name" required/>
                </label>
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
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

            {{-- Password --}}
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

            {{-- Confirm Password --}}
            <div class="flex flex-col">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Confirm Password</span>
                    </div>
                    <input type="password" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                           wire:model.defer="password_confirmation" required/>
                </label>
            </div>

            {{-- Terms and Conditions --}}
            <div class="flex items-center">
                <div class="form-control">
                    <label class="label cursor-pointer gap-2">
                        <input type="checkbox" wire:model.defer="terms" class="checkbox"/>
                        <span class="label-text">I agree to the terms and conditions</span>
                    </label>
                </div>
            </div>

            {{-- Display terms validation error --}}
            @error('terms')
            <span class="text-red-500 text-sm">You must agree to the terms and conditions to register.</span>
            @enderror

            <div class="flex items-center justify-center">
                <button type="submit"
                        class="btn btn-primary">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
