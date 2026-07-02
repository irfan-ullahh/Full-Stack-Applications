<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon-placeholder.webp') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>@stack('title') | Pay Flow | Uet</title>
</head>

<body class="bg-gradient-to-br from-indigo-950 via-purple-950 to-zinc-950 p-3">
    <header class="bg-white/5 border border-white/10 rounded-lg p-2 flex justify-between items-center mb-4 lg:hidden">
        <div class="flex items-center gap-3">
            <img width="35" src="assets/logo.png" alt="">
            <h1 class="text-white text-lg font-semibold">Uet Pay Flow</h1>
        </div>
        <div onclick="showResponsiveAside()"
            class="bg-white/5 border border-white/10 p-1.5 rounded-lg text-white cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M3 5h18M3 12h18M3 19h18"></path>
            </svg>
        </div>
    </header>
    <div class="flex gap-4">
        <aside id="responsiveAside"
            class="space-y-5 bg-white/5 border border-white/10 rounded-lg w-xs px-3 py-5 fixed shrink-0 "
            style="height: calc(100% - 24px);">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img width="50" src="assets/logo.png" alt="">
                    <div>
                        <h1 class="text-white text-lg font-semibold">Uet Pay Flow</h1>
                        <p class="text-zinc-400 text-xs tracking-wide">Enter your credential</p>
                    </div>
                </div>
                <div onclick="closeResponsiveAside()"
                    class="lg:hidden bg-white/5 border border-white/10 p-1.5 rounded-lg text-white cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5" d="M19.5 12h-15m0 0l5.625-6M4.5 12l5.625 6"></path>
                    </svg>
                </div>
            </div>
            <hr class="border-0 bg-white/10 h-0.5">
            <ul class="space-y-2 relative">
                <li
                    class="rounded-lg p-2 relative navigaton-hover {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a class="flex items-center gap-2 text-white text-sm" href="{{ route('user.dashboard') }}"
                        wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M6.047 1H2.14A1.14 1.14 0 0 0 1 2.14v5.657a1.14 1.14 0 0 0 1.14 1.14h3.907a1.14 1.14 0 0 0 1.14-1.14V2.14A1.14 1.14 0 0 0 6.046 1m.162 6.797a.163.163 0 0 1-.162.162H2.14a.163.163 0 0 1-.163-.162V2.14a.163.163 0 0 1 .163-.163h3.907a.163.163 0 0 1 .162.163zm-.162 2.767H2.14A1.14 1.14 0 0 0 1 11.704v2.156A1.14 1.14 0 0 0 2.14 15h3.907a1.14 1.14 0 0 0 1.14-1.14v-2.156a1.14 1.14 0 0 0-1.14-1.14m.162 3.297a.163.163 0 0 1-.162.162H2.14a.163.163 0 0 1-.163-.162v-2.158a.163.163 0 0 1 .163-.162h3.907a.163.163 0 0 1 .162.162zM13.861 1H9.953a1.14 1.14 0 0 0-1.139 1.14v2.157a1.14 1.14 0 0 0 1.14 1.14h3.906A1.14 1.14 0 0 0 15 4.296V2.14A1.14 1.14 0 0 0 13.86 1m.162 3.297a.163.163 0 0 1-.162.162H9.953a.163.163 0 0 1-.162-.162V2.14a.163.163 0 0 1 .162-.163h3.908a.163.163 0 0 1 .162.163zm-.248 2.767H9.867a1.14 1.14 0 0 0-1.14 1.14v5.656A1.14 1.14 0 0 0 9.867 15h3.907a1.14 1.14 0 0 0 1.14-1.14V8.204a1.14 1.14 0 0 0-1.14-1.139m.163 6.797a.163.163 0 0 1-.163.162H9.867a.163.163 0 0 1-.163-.162V8.203a.163.163 0 0 1 .163-.162h3.907a.163.163 0 0 1 .163.162z"
                                stroke-width="0.5" stroke="currentColor"></path>
                        </svg>
                        Dashboard</a>
                </li>
                <li
                    class="rounded-lg relative p-2 navigaton-hover {{ request()->routeIs('user.deposit') ? 'active' : '' }}">
                    <a class="flex items-center gap-2 text-white text-sm" href="{{ route('user.deposit') }}"
                        wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 256 256">
                            <path fill="currentColor"
                                d="M128 35.31V128a8 8 0 0 1-16 0V35.31L93.66 53.66a8 8 0 0 1-11.32-11.32l32-32a8 8 0 0 1 11.32 0l32 32a8 8 0 0 1-11.32 11.32Zm64 88.31V96a16 16 0 0 0-16-16h-16a8 8 0 0 0 0 16h16v80.4a28 28 0 0 0-44.25 33.6l.24.38l22.26 34a8 8 0 0 0 13.39-8.76l-22.13-33.79A12 12 0 0 1 166.4 190c.07.13.15.26.23.38l10.68 16.31a8 8 0 0 0 14.69-4.38V144a74.84 74.84 0 0 1 24 54.69V240a8 8 0 0 0 16 0v-41.35a90.89 90.89 0 0 0-40-75.03M80 80H64a16 16 0 0 0-16 16v104a8 8 0 0 0 16 0V96h16a8 8 0 0 0 0-16"
                                stroke-width="6.5" stroke="currentColor" />
                        </svg>
                        Deposit Funds</a>
                </li>
                <li
                    class="rounded-lg relative p-2 navigaton-hover {{ request()->routeIs('user.transfer') ? 'active' : '' }}">
                    <a class="flex items-center gap-2 text-white text-sm" href="{{ route('user.transfer') }}"
                        wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 24 24">
                            <g fill="none">
                                <path
                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                <path fill="currentColor"
                                    d="M8.122 3.464c.665-.666 1.784-.24 1.872.662l.006.115V20a1 1 0 0 1-1.993.117L8 20V6.414L5.707 8.707a1 1 0 0 1-1.497-1.32l.083-.094l3.83-3.83ZM15 3a1 1 0 0 1 .993.883L16 4v13.586l2.293-2.293a1 1 0 0 1 1.497 1.32l-.083.094l-3.83 3.83c-.664.665-1.783.239-1.871-.663L14 19.759V4a1 1 0 0 1 1-1"
                                    stroke-width="0.5" stroke="currentColor" />
                            </g>
                        </svg>
                        Transfer Money</a>
                </li>
                <li
                    class="rounded-lg relative p-2 navigaton-hover {{ request()->routeIs('user.transaction') ? 'active' : '' }}">
                    <a class="flex items-center gap-2 text-white text-sm" href="{{ route('user.transaction') }}"
                        wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 21q-3.15 0-5.575-1.912T3.275 14.2q-.1-.375.15-.687t.675-.363q.4-.05.725.15t.45.6q.6 2.25 2.475 3.675T12 19q2.925 0 4.963-2.037T19 12t-2.037-4.962T12 5q-1.725 0-3.225.8T6.25 8H8q.425 0 .713.288T9 9t-.288.713T8 10H4q-.425 0-.712-.288T3 9V5q0-.425.288-.712T4 4t.713.288T5 5v1.35q1.275-1.6 3.113-2.475T12 3q1.875 0 3.513.713t2.85 1.924t1.925 2.85T21 12t-.712 3.513t-1.925 2.85t-2.85 1.925T12 21m1-9.4l2.5 2.5q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-2.8-2.8q-.15-.15-.225-.337T11 11.975V8q0-.425.288-.712T12 7t.713.288T13 8z"
                                stroke-width="0.5" stroke="currentColor" />
                        </svg>
                        Transaction History</a>
                </li>
            </ul>
            <ul class="absolute bottom-4 space-y-2" style="width: calc(100% - 24px);">
                <li class="bg-white/5 border border-white/10 rounded-lg p-2 hover:border-indigo-500/50">
                    <a class="flex items-center gap-2 text-white text-sm" href="{{ route('user.setting') }}"
                        wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16">
                            <g fill="none" stroke="currentColor" stroke-width="1">
                                <path
                                    d="m13.258 8.354l.904.805a.91.91 0 0 1 .196 1.169l-1.09 1.862a.94.94 0 0 1-.35.341a1 1 0 0 1-.478.125a1 1 0 0 1-.306-.046l-1.157-.382q-.304.195-.632.349l-.243 1.173a.93.93 0 0 1-.339.544a.97.97 0 0 1-.618.206H6.888a.97.97 0 0 1-.618-.206a.93.93 0 0 1-.338-.544l-.244-1.173a6 6 0 0 1-.627-.35L3.9 12.61a1 1 0 0 1-.306.046a1 1 0 0 1-.477-.125a.94.94 0 0 1-.35-.34l-1.129-1.863a.91.91 0 0 1 .196-1.187L2.737 8v-.354l-.904-.805a.91.91 0 0 1-.196-1.169L2.766 3.81a.94.94 0 0 1 .35-.341a1 1 0 0 1 .477-.125a1 1 0 0 1 .306.028l1.138.4q.305-.195.632-.349l.244-1.173a.93.93 0 0 1 .338-.544a.97.97 0 0 1 .618-.206h2.238a.97.97 0 0 1 .618.206c.175.137.295.33.338.544l.244 1.173q.325.155.627.35l1.162-.382a.98.98 0 0 1 .784.078c.145.082.265.2.35.34l1.128 1.863a.91.91 0 0 1-.182 1.187l-.918.782z" />
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0Z" />
                            </g>
                        </svg>
                        Settings</a>
                </li>
                <li
                    class="bg-white/5 border border-white/10 rounded-lg p-2 hover:border-indigo-500/50 flex justify-between items-center">
                    <a class="flex items-center gap-2 text-white text-sm" href="{{ route('user.profile') }}"
                        wire:navigate>
                        <img class="rounded-full object-cover w-8 h-8" src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('assets/user.jpeg') }}" alt="">
                        <div class="leading-none">
                            {{ Auth::user()->full_name }} <br>
                            <span class="text-[11px]">{{ Auth::user()->registration_number }}</span>
                        </div>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-red-400 bg-red-800/30 rounded-full p-1.5 cursor-pointer" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="1.5"
                                    d="M4.393 4C4 4.617 4 5.413 4 7.004v9.994c0 1.591 0 2.387.393 3.002q.105.165.235.312c.483.546 1.249.765 2.78 1.202c1.533.438 2.3.657 2.856.329a1.5 1.5 0 0 0 .267-.202C11 21.196 11 20.4 11 18.803V5.197c0-1.596 0-2.393-.469-2.837a1.5 1.5 0 0 0-.267-.202c-.555-.328-1.323-.11-2.857.329c-1.53.437-2.296.656-2.78 1.202a2.5 2.5 0 0 0-.234.312M11 4h2.017c1.902 0 2.853 0 3.443.586c.33.326.476.764.54 1.414m-6 14h2.017c1.902 0 2.853 0 3.443-.586c.33-.326.476-.764.54-1.414m4-6h-7m5.5-2.5S22 11.34 22 12s-2.5 2.5-2.5 2.5" />
                            </svg>
                        </button>
                    </form>
                </li>

            </ul>
        </aside>
        <div class="w-[318px] shrink-0 lg:block hidden"></div>
        <div class="min-h-screen w-full">
            {{ $slot }}
        </div>
    </div>
    <script src="{{ asset('assets/script.js') }}"></script>
</body>

</html>
