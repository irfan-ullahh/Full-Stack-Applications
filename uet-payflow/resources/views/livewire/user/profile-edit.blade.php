<main class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-5 flex items-center justify-center">
    @push('title')
        Deposit Funds
    @endpush
    @include('alerts')
    <div class="text-white w-md space-y-2">
        <div class="md:w-lg">
            <div class="space-y-10">
                <div class="rounded-xl shrink-0 w-fit mx-auto">
                    <div class="w-64 h-64 bg-cover bg-center rounded-lg border border-white/10 relative"
                        style="background-image: url('{{ $profile_image ? $profile_image->temporaryUrl() : ($old_profile_image ? asset($old_profile_image) : asset('assets/user.jpeg')) }}');">
                        <button onclick="document.getElementById('profile_image').click()"
                            class="bg-white/5 border border-white/10 rounded-full p-2 text-white absolute bottom-3 right-1/2 translate-x-1/2
                            hover:bg-white/10 cursor-pointer
                           duration-300 transition-all  shadow-lg shadow-indigo-500/10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="3 3 18 18">
                                <path fill="currentColor"
                                    d="M6.616 19q-.691 0-1.153-.462T5 17.384v-1.923q0-.213.143-.356t.357-.144t.357.144t.143.356v1.923q0 .231.192.424t.423.192h10.77q.23 0 .423-.192t.192-.424v-1.923q0-.213.143-.356t.357-.144t.357.144t.143.356v1.923q0 .691-.462 1.153T17.384 19zM11.5 6.927L9.529 8.898q-.146.146-.347.153t-.366-.159q-.16-.165-.163-.353q-.003-.189.163-.354l2.618-2.62q.132-.13.268-.183q.137-.053.298-.053t.298.053t.268.184l2.618 2.619q.147.146.154.344q.006.198-.153.363q-.166.166-.357.169t-.357-.163L12.5 6.927v8.15q0 .214-.143.357t-.357.143t-.357-.143t-.143-.357z"
                                    stroke-width="0.5" stroke="currentColor" />
                            </svg>
                        </button>
                    </div>

                </div>
                <form wire:submit.prevent="update_profile">
                    @csrf
                    <input class="hidden" type="file" wire:model="profile_image" id="profile_image" />
                    <div class="relative group mb-3 w-full">
                        <input type="text" id="full_name" name="full_name" wire:model="full_name"
                            class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
                            placeholder=" " autocomplete="off" />
                        <label for="full_name"
                            class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                            Full Name
                        </label>
                    </div>
                    <div class="sm:flex gap-3 w-full">
                        <div class="w-full">
                            <div class="relative group mb-3 w-full">
                                <input type="email" id="email" name="full_name" wire:model="email"
                                    class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
                                    placeholder=" " autocomplete="off" />
                                <label for="email"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                                    Email Address
                                </label>
                            </div>
                            <div class="relative group mb-3 w-full">
                                <input type="tel" id="phone_number" name="phone_number" wire:model="phone_number"
                                    class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
                                    placeholder=" " autocomplete="off" />
                                <label for="phone_number"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                                    Phone Number
                                </label>
                            </div>
                            <div class="relative group mb-3 w-full">
                                <input type="date" id="birth_date" name="birth_date" wire:model="birth_date"
                                    class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer [color-scheme:dark]"
                                    placeholder=" " autocomplete="off" />
                                <label for="birth_date"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                                    Birth Date
                                </label>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="relative group mb-3 w-full">
                                <input type="text" id="student_id" name="student_id" wire:model="student_id" disabled
                                    class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-zinc-300 text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
                                    placeholder=" " autocomplete="off" />
                                <label for="student_id"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                                    Student Id
                                </label>
                            </div>
                            <div class="relative group mb-3">
                                <select id="department" wire:model="department"
                                    class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 rounded-lg border border-white/10 text-white text-sm 
                                 focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 
                                 transition-all duration-200 peer appearance-none cursor-pointer"
                                    style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23a1a1aa%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); 
                                 background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1rem;">
                                    <option selected disabled class="bg-gray-800 text-zinc-500">-------</option>
                                    <option value="Electrical Engineering" class="bg-gray-800 text-white">
                                        Electrical Engineering
                                    </option>
                                    <option value="Computer Systems Engineering" class="bg-gray-800 text-white">
                                        Computer Systems Engineering
                                    </option>
                                    <option value="Computer Science" class="bg-gray-800 text-white">
                                        Computer Science
                                    </option>
                                    <option value="Mechanical Engineering" class="bg-gray-800 text-white">
                                        Mechanical Engineering
                                    </option>
                                    <option value="Chemical Engineering" class="bg-gray-800 text-white">
                                        Chemical Engineering
                                    </option>
                                    <option value="Industrial Engineering" class="bg-gray-800 text-white">
                                        Industrial Engineering
                                    </option>
                                    <option value="Civil Engineering" class="bg-gray-800 text-white">
                                        Civil Engineering
                                    </option>

                                    <option value="Mining Engineering" class="bg-gray-800 text-white">
                                        Mining Engineering
                                    </option>
                                    <option value="Agricultural Engineering" class="bg-gray-800 text-white">
                                        Agricultural Engineering
                                    </option>

                                </select>
                                <label for="department"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                                    Department
                                </label>
                            </div>
                            <div class="relative group mb-3 w-full">
                                <input type="text" id="postal_code" name="postal_code" wire:model="postal_code"
                                    class="w-full h-12 px-3 pt-3 pb-0.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer"
                                    placeholder=" " autocomplete="off" />
                                <label for="postal_code"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:-translate-y-0 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:-translate-y-0 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                                    Postal Code
                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="relative group mb-3 w-full">
                            <textarea id="address" name="address" wire:model="address"
                                class="w-full h-20 px-3 py-3 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-indigo-500/50 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 transition-all duration-200 peer resize-none"
                                placeholder=" " autocomplete="off"></textarea>
                            <label for="address"
                                class="absolute left-3 top-3 text-zinc-300 text-xs transition-all duration-200 pointer-events-none peer-placeholder-shown:top-3 peer-placeholder-shown:text-xs peer-focus:top-1.5 peer-focus:text-[10px] peer-focus:text-indigo-400 peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:text-[10px] peer-[:not(:placeholder-shown)]:text-zinc-300">
                                Address
                            </label>
                        </div>
                    </div>
                    <button type="submit"
                        class="border border-white/10 rounded-lg text-white text-sm w-full bg-indigo-500/50 hover:bg-indigo-500/60 duration-300 transition-all py-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Update Profile</span>
                        <span wire:loading class="flex items-center justify-center gap-2">
                            Processing...
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
