 <main class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-5 h-143 flex items-center justify-center">
     @push('title')
         Tranfer Funds
     @endpush
     @include('alerts')
     <div class="text-white w-md space-y-2">
         <div class="bg-white/5 border border-white/10 p-3 rounded-lg">
             <p class="text-primary text-2xl font-bold">Transfer Money</p>
             <p class="text-muted text-xs text-white">Send funds to another student</p>
         </div>
         <div class="bg-white/5 border border-white/10 p-3 rounded-lg space-y-4">
             <div class="flex items-center gap-2">
                 <span class="bg-green-500/10 rounded-xl p-2">
                     <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                         <g fill="none">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="1.5" d="M6 8h4"></path>
                             <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                 d="M22 10.5c0-.077 0-.533-.002-.565c-.036-.501-.465-.9-1.005-.933C20.959 9 20.918 9 20.834 9h-2.602C16.446 9 15 10.343 15 12s1.447 3 3.23 3h2.603c.084 0 .125 0 .16-.002c.54-.033.97-.432 1.005-.933c.002-.032.002-.488.002-.565">
                             </path>
                             <circle cx="18" cy="12" r="1" fill="currentColor"></circle>
                             <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                 d="M13 4c3.771 0 5.657 0 6.828 1.172c.809.808 1.06 1.956 1.137 3.828M10 20h3c3.771 0 5.657 0 6.828-1.172c.809-.808 1.06-1.956 1.137-3.828M9 4c-3.114.01-4.765.108-5.828 1.172C2 6.343 2 8.229 2 12s0 5.657 1.172 6.828c.653.654 1.528.943 2.828 1.07">
                             </path>
                         </g>
                     </svg>
                 </span>
                 <div class="">
                     <p class="text-muted text-xs">Available Balance</p>
                     <p class="text-primary text-xl font-bold">Rs. {{ number_format($available_balance, 2) }}</p>
                 </div>
             </div>
             <div class="relative group">
                 <select id="recipient" wire:model="recipient_id"
                     class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm 
                        focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 
                        transition-all duration-200 peer appearance-none cursor-pointer"
                     style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23a1a1aa%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); 
                        background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1rem;">
                     <option selected disabled value="" class="bg-gray-800 text-zinc-500">------</option>
                     @foreach ($users as $user)
                         <option value="{{ $user->id }}" class="bg-gray-800 text-white">
                             {{ $user->registration_number }} - {{ $user->full_name }}
                         </option>
                     @endforeach
                 </select>
                 <label for="recipient"
                     class="absolute left-3 top-1.5 -translate-y-0 text-indigo-400 text-[10px] transition-all duration-200 pointer-events-none">
                     Recipient
                 </label>
             </div>
         </div>
         <form wire:submit.prevent="transfer" class="bg-white/5 border border-white/10 p-3 rounded-lg space-y-3">
             <div class="relative group">
                 <input type="number" id="amount" name="amount" wire:model="amount"
                     class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
                     placeholder=" " autocomplete="username">
                 <label for="amount"
                     class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                     Amount (PKR)
                 </label>
             </div>
             <div class="flex gap-2">
                 <button type="button" wire:click="addAmount(500)"
                     class="flex-1 bg-white/5 border border-white/10 cursor-pointer hover:bg-white/20 text-white text-xs py-2 rounded-lg transition">+500</button>
                 <button type="button" wire:click="addAmount(2000)"
                     class="flex-1 bg-white/5 border border-white/10 cursor-pointer hover:bg-white/20 text-white text-xs py-2 rounded-lg transition">+2,000</button>
                 <button type="button" wire:click="addAmount(5000)"
                     class="flex-1 bg-white/5 border border-white/10 cursor-pointer hover:bg-white/20 text-white text-xs py-2 rounded-lg transition">+5,000</button>
                 <button type="button" wire:click="addAmount(10000)"
                     class="flex-1 bg-white/5 border border-white/10 cursor-pointer hover:bg-white/20 text-white text-xs py-2 rounded-lg transition">+10,000</button>
             </div>
             <div class="relative group">
                 <input type="password" id="pin" name="pin" wire:model="pin"
                     class="w-full h-11 px-3 pt-3 pb-0.5 pr-10 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
                     placeholder=" " autocomplete="off" maxlength="4" inputmode="numeric">
                 <label for="pin"
                     class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                     4 digits pin
                 </label>
                 <button type="button"
                     class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-zinc-300 hover:text-white transition-colors cursor-pointer"
                     data-target="pin">
                     <svg class="eye-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                         </path>
                     </svg>
                 </button>
             </div>
             <div class="mt-12">
                 <button type="submit"
                     class="border border-white/10 rounded-lg text-white text-sm w-full bg-indigo-500/50 hover:bg-indigo-500/60 duration-300 transition-all py-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                     wire:loading.attr="disabled">
                     <span wire:loading.remove>Deposit Funds</span>
                     <span wire:loading class="flex items-center justify-center gap-2">
                         Processing...
                     </span>
                 </button>
             </div>
         </form>
     </div>
     @if ($showSuccessModal)
         <div class="fixed top-0 right-0 w-full h-full flex justify-center items-center z-50">
             <!-- Backdrop -->
             <div class="absolute top-0 right-0 w-full h-full inset-0 bg-black/40 backdrop-blur-sm"
                 wire:click="closeModal"></div>

             <!-- Modal Content -->
             <div
                 class="relative bg-white/5 border border-white/10 rounded-2xl pb-8 px-6 w-sm z-10 shadow-2xl animate-in">
                 <!-- Success Icon / Video -->
                 <div class="flex justify-center">
                     <video class="block mx-auto" width="200px" autoplay
                         src="{{ asset('assets/Done.webm') }}"></video>
                 </div>

                 <!-- Status Text -->
                 <div class="text-center mt-4 space-y-1">
                     <p class="text-white text-xl font-bold font-inter">Transfer Successful!</p>
                     <p class="text-white text-xs">Your money has been sent successfully</p>
                 </div>

                 <!-- Transaction Details -->
                 <div class="bg-white/5 border border-white/10 rounded-xl p-3 mt-6 space-y-2">
                     <div class="flex justify-between text-xs">
                         <span class="text-white">Transaction ID</span>
                         <span class="text-white font-mono">{{ $lastTransactionId }}</span>
                     </div>
                     <hr class="border-t border-white/5">
                     <div class="flex justify-between text-xs">
                         <span class="text-white">Sent To</span>
                         <span class="text-indigo-400 font-semibold">{{ $recipientName }}</span>
                     </div>
                     <hr class="border-t border-white/5">
                     <div class="flex justify-between text-xs">
                         <span class="text-white">Amount</span>
                         <span class="text-red-400 font-semibold">-Rs. {{ number_format($lastAmount, 2) }}</span>
                     </div>
                     <hr class="border-t border-white/5">
                     <div class="flex justify-between text-xs">
                         <span class="text-white">Date & Time</span>
                         <span class="text-white">{{ $transactionDate }}</span>
                     </div>
                     <hr class="border-t border-white/5">
                     <div class="flex justify-between text-xs">
                         <span class="text-white">New Balance</span>
                         <span class="text-white font-semibold">Rs. {{ number_format($newBalance, 2) }}</span>
                     </div>
                 </div>

                 <!-- Action Buttons -->
                 <div class="flex gap-3 mt-6">
                     <a href="{{ route('user.dashboard') }}" wire:navigate
                         class="flex-1 border border-white/10 text-center rounded-xl text-white text-sm bg-white/5 hover:bg-white/10 
                           duration-300 transition-all py-2.5 cursor-pointer font-medium">
                         Dashboard
                     </a>
                     <button wire:click="closeModal"
                         class="flex-1 border border-indigo-500/30 rounded-xl text-white text-sm 
                           bg-gradient-to-r from-indigo-500/50 to-indigo-500/40 hover:from-indigo-500/60 hover:to-indigo-500/50 
                           duration-300 transition-all py-2.5 cursor-pointer font-medium shadow-lg shadow-indigo-500/10">
                         Another Transaction
                     </button>
                 </div>

             </div>
         </div>
     @endif
 </main>
