 <main class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-5 space-y-2">
     <!-- Profile Header -->
     <div class="sm:flex items-center justify-between border-b border-white/10 pb-4">
         <div class="flex items-center gap-4 sm:mb-0 mb-5">
             <img class="w-20 h-20 rounded-full object-cover border-2 border-indigo-500"
                 src="{{ $user->profile_image ? asset($user->profile_image) : asset('assets/user.jpeg') }}"
                 alt="Profile">
                 
             <div>
                 <h2 class="text-white text-xl font-semibold">{{ $user->full_name }}</h2>
                 <p class="text-zinc-400 text-sm">{{ $user->registration_number }}</p>
                 <span class="text-xs bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full mt-1 inline-block">Verified
                     Account</span>
             </div>
         </div>
         <a href="{{ route('user.edit-profile') }}" wire:navigate
             class="border border-indigo-500/30 rounded-xl text-white text-sm px-4  
                           bg-gradient-to-r from-indigo-500/50 to-indigo-500/40 hover:from-indigo-500/60 hover:to-indigo-500/50 
                           duration-300 transition-all py-2.5 font-medium shadow-lg shadow-indigo-500/10">
             Edit Profile
         </a>
     </div>

     <div class="grid sm:grid-cols-2 gap-4 mt-4">
         <div class="bg-white/5 border border-white/10 rounded-lg p-4">
             <p class="text-zinc-400 text-xs mb-2">Full Name</p>
             <p class="text-white text-sm">{{ $user->full_name }}</p>
             <hr class="border-0 bg-white/10 h-0.5 my-2">
             <p class="text-zinc-400 text-xs mb-2">Student ID</p>
             <p class="text-white text-sm">{{ $user->registration_number }}</p>
         </div>
         <div class="bg-white/5 border border-white/10 rounded-lg p-4">
             <p class="text-zinc-400 text-xs mb-2">Phone Number</p>
             <p class="text-white text-sm">{{ $user->phone_number ?? '------' }}</p>
             <hr class="border-0 bg-white/10 h-0.5 my-2">
             <p class="text-zinc-400 text-xs mb-2">Email</p>
             <p class="text-white text-sm">{{ $user->email ?? '------' }}</p>
         </div>
         <div class="bg-white/5 border border-white/10 rounded-lg p-4">
             <p class="text-zinc-400 text-xs mb-2">Date of Birth</p>
             <p class="text-white text-sm">{{ $user->birth_date ?? '------' }}</p>
             <hr class="border-0 bg-white/10 h-0.5 my-2">
             <p class="text-zinc-400 text-xs mb-2">Department</p>
             <p class="text-white text-sm">{{ $user->department ?? '------' }}</p>
         </div>
         <div class="bg-white/5 border border-white/10 rounded-lg p-4">
             <p class="text-zinc-400 text-xs mb-2">Address</p>
             <p class="text-white text-sm">{{ $user->address ?? '------' }}</p>
             <hr class="border-0 bg-white/10 h-0.5 my-2">
             <p class="text-zinc-400 text-xs mb-2">Postal Code</p>
             <p class="text-white text-sm">{{ $user->postal_code ?? '------' }}</p>
         </div>
     </div>

     <!-- Recent Devices -->
     <!-- resources/views/livewire/user/profile.blade.php -->

     <div>
         <!-- Recent Devices Section -->
         <div class="bg-white/5 border border-white/10 rounded-lg p-4 mt-4">
             <div class="flex justify-between items-center mb-3">
                 <h3 class="text-white font-semibold">Recent Devices</h3>
                 <div class="flex gap-2">
                     <span class="text-xs text-zinc-400">Last 30 days</span>
                     @if (count($sessions) > 1)
                         <button wire:click="logoutAllOtherDevices"
                             class="text-xs text-red-400 hover:text-red-300 transition">
                             Logout All
                         </button>
                     @endif
                 </div>
             </div>

             <div class="space-y-3">
                 @forelse($sessions as $session)
                     <div class="flex items-center justify-between p-3 bg-white/5 rounded-lg">
                         <div class="flex items-center gap-3">
                             <!-- Device Icon based on type -->
                             <div class="bg-indigo-500/20 p-2 rounded-lg">
                                 @if (str_contains($session['device_name'], 'iPhone') || str_contains($session['device_name'], 'Android Phone'))
                                     <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <rect x="4" y="2" width="16" height="20" rx="2"
                                             stroke-width="1.5"></rect>
                                         <path d="M12 18h.01" stroke-width="1.5"></path>
                                     </svg>
                                 @elseif(str_contains($session['device_name'], 'iPad') || str_contains($session['device_name'], 'Android Tablet'))
                                     <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <rect x="6" y="2" width="12" height="20" rx="2"
                                             stroke-width="1.5"></rect>
                                         <path d="M12 18h.01" stroke-width="1.5"></path>
                                     </svg>
                                 @elseif(str_contains($session['device_name'], 'Windows') || str_contains($session['device_name'], 'Mac'))
                                     <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <path d="M4 4v16h16V4H4zm2 2h12v12H6V6z" stroke-width="1.5"></path>
                                     </svg>
                                 @else
                                     <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <circle cx="12" cy="8" r="4" stroke-width="1.5"></circle>
                                         <path d="M5 20v-2a7 7 0 0114 0v2" stroke-width="1.5"></path>
                                     </svg>
                                 @endif
                             </div>
                             <div>
                                 <p class="text-white text-sm">{{ $session['device_name'] }}</p>
                                 <p class="text-zinc-500 text-xs">{{ $session['location'] }} •
                                     {{ $session['last_activity'] }}</p>
                                 <p class="text-zinc-600 text-xs mt-1">{{ $session['ip_address'] }}</p>
                             </div>
                         </div>
                         <div class="flex items-center gap-2">
                             @if ($session['is_current'])
                                 <span class="text-green-400 text-xs bg-green-500/10 px-2 py-1 rounded">Current</span>
                             @else
                                 <button wire:click="removeSession('{{ $session['id'] }}')"
                                     wire:confirm="Are you sure you want to remove this device?"
                                     class="text-xs text-zinc-400 hover:text-red-400 transition">
                                     Remove
                                 </button>
                             @endif
                         </div>
                     </div>
                 @empty
                     <tr>
                         <td colspan="7">
                             <div class="text-center py-6">
                                 <svg class="text-zinc-400 mx-auto mb-3" width="100"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                     <path d="M0 0h24v24H0z" fill="none" />
                                     <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1">
                                         <path
                                             d="M16.093 13C17.23 12.098 18 10.85 18 9.47C18 6.72 14.945 2 12 2C9.054 2 6 6.72 6 9.47c0 1.38.77 2.628 1.908 3.53" />
                                         <path stroke-linejoin="round"
                                             d="M13.5 14c-.484 4 .4 5.714 3.5 8m-6.5-8c.484 4-.4 5.714-3.5 8m6.5-8c1 2 3.58 4.5 5.547 4.5c1.969 0 2.953-1.231 2.953-2.75S20.898 13 19.54 13m-9.04 1c-1 2-3.58 4.5-5.548 4.5S2 17.269 2 15.75S3.102 13 4.46 13" />
                                         <path
                                             d="M10.125 10H10m.25 0a.25.25 0 1 1-.5 0a.25.25 0 0 1 .5 0Zm3.875 0H14m.25 0a.25.25 0 1 1-.5 0a.25.25 0 0 1 .5 0Z" />
                                     </g>
                                 </svg>
                                 <p class="text-zinc-400 text-sm">No Sessions Found!</p>
                             </div>
                         </td>
                     </tr>
                 @endforelse
             </div>
         </div>
     </div>

 </main>
