<main
            class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-5 h-143 flex items-center justify-center">
                @push('title')Settings @endpush
                @include('alerts')
           <div class="space-y-5">
           <div class="bg-yellow-500/10 border border-yellow-500/30 p-3 rounded-lg">
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 text-yellow-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-yellow-400 text-xs font-semibold">Security Tips:</p>
                        <p class="text-zinc-400 text-xs mt-1">
                            • Never share your PIN with anyone<br>
                            • Choose a PIN that's easy for you to remember but hard for others to guess<br>
                            • Avoid using common numbers like 1234 or 0000
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-white/5 border border-white/10 p-4 rounded-lg">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <p class="text-white font-semibold">Change PIN</p>
                </div>



                <form wire:submit.prevent="changePin" class="space-y-4">

 <div class="relative group">
    <input type="password" id="current_pin" name="current_pin" wire:model="current_pin"
        class="w-full h-11 px-3 pt-3 pb-0.5 pr-10 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
        placeholder=" " autocomplete="off" maxlength="4" inputmode="numeric">
    <label for="current_pin"
        class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
        Current PIN
    </label>
    <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-zinc-300 hover:text-white transition-colors cursor-pointer" 
        data-target="current_pin">
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

                    
                    <div class="mt-6">
                          <button type="submit"
    class="border border-white/10 rounded-lg text-white text-sm w-full bg-indigo-500/50 hover:bg-indigo-500/60 duration-300 transition-all py-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
    wire:loading.attr="disabled"
    >
    <span wire:loading.remove >Change PIN</span>
    <span wire:loading  class="flex items-center justify-center gap-2">
        Processing...
    </span>
</button>
                       
                    </div>
                </form>
            </div>
            </div>
              
        </main>