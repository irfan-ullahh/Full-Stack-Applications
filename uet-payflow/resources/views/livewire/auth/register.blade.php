<form wire:submit.prevent="register">
    @include('alerts')
    @push('title')
        Register
    @endpush
    <div class="mb-10">
        <img width="90" src="{{ asset('assets/logo.png') }}" alt="">
        <h1 class="text-white text-3xl font-bold mt-5 mb-2">Uet Pay Flow</h1>
        <p class="text-zinc-400 text-sm tracking-wide">Enter your credentials to securely access your account.</p>
        <p class="text-zinc-400 text-sm tracking-wide mt-1">Alrady have account? <a href="{{ route('login') }}" wire:navigate
                class="text-indigo-400 hover:text-indigo-300 underline">Login</a></p>
    </div>
    <div class="relative group mb-3">
        <input type="text" id="full_name" name="full_name" wire:model="full_name"
            class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
            placeholder=" " autocomplete="off" />
        <label for="full_name"
            class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
            Full Name
        </label>
    </div>
    <div class="relative group mb-3">
        <input type="text" id="registration" name="registration" wire:model="registration"
            class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
            placeholder=" " autocomplete="off" />
        <label for="registration"
            class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
            Registration No.
        </label>
    </div>
    <div class="relative group mt-4">
    <input type="password" id="new_pin" name="new_pin" wire:model="new_pin"
        class="w-full h-11 px-3 pt-3 pb-0.5 pr-10 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
        placeholder=" " autocomplete="off" maxlength="4" inputmode="numeric">
    <label for="new_pin"
        class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
        New PIN
    </label>
    <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-zinc-300 hover:text-white transition-colors cursor-pointer" 
        data-target="new_pin">
        <svg class="eye-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
            </path>
        </svg>
    </button>
</div>

<div class="relative group mt-4">
    <input type="password" id="confirm_pin" name="confirm_pin" wire:model="confirm_pin"
        class="w-full h-11 px-3 pt-3 pb-0.5 pr-10 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
        placeholder=" " autocomplete="off" maxlength="4" inputmode="numeric">
    <label for="confirm_pin"
        class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
        Confirm PIN
    </label>
    <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-zinc-300 hover:text-white transition-colors cursor-pointer" 
        data-target="confirm_pin">
        <svg class="eye-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
            </path>
        </svg>
    </button>
</div>
    <div class="mt-10">
                 <button type="submit"
    class="border border-white/10 rounded-lg text-white text-sm w-full bg-indigo-500/50 hover:bg-indigo-500/60 duration-300 transition-all py-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
    wire:loading.attr="disabled"
    >
    <span wire:loading.remove >Continue</span>
    <span wire:loading  class="flex items-center justify-center gap-2">
        Processing...
    </span>
</button>
    </div>
</form>
