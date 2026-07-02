
<div class="absolute right-0 top-3 flex justify-center w-full">
    @if(session('success') || $success)
   
    <div class="bg-white/5 border backdrop-blur-sm border-white/10 rounded-lg px-2 py-1 flex items-center gap-2 w-xs">
       
<svg class="text-green-500" xmlns="http://www.w3.org/2000/svg" width="22" viewBox="4 4 16 16">
	<g fill="none">
		<circle cx="12" cy="12" r="8" fill="currentColor" fill-opacity="0.25" />
		<path stroke="currentColor" stroke-width="1.2" d="m9.5 12l1.894 1.894a.15.15 0 0 0 .212 0L15.5 10" />
	</g>
</svg>

        <div>
            <p class="text-white text-[13px] leading-none">{{ session('success') }} {{ $success }}</p>
        </div>
        </div>
@endif
    @if ($errors->any() || session('error') || $error)
        <div class="bg-white/5 border backdrop-blur-sm border-white/10 rounded-lg px-2 py-1 flex items-center gap-2 w-xs">
            <svg class="text-red-500" xmlns="http://www.w3.org/2000/svg" width="27" viewBox="0 0 24 24">
                <g fill="none">
                    <circle cx="12" cy="12" r="9" fill="currentColor" fill-opacity="0.25"></circle>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="m16 8l-8 8m0-8l8 8"></path>
                </g>
            </svg>
        <div>
              @foreach($errors->all() as $err)
                <p class="text-white text-sm leading-tight">{{ $err }}</p>
            @endforeach
            @if(session('error'))
                <p class="text-white text-sm leading-tight">{{ session('error') }}</p>
            @endif
            @if($error && !$errors->has($error) && !session('error'))
                <p class="text-white text-sm leading-tight">{{ $error }}</p>
            @endif
        </div>
        </div>
        @endif

    </div>
