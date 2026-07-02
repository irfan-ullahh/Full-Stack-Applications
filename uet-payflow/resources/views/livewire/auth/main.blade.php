<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>@stack('title') | Pay Flow | Uet</title>
</head>

<body
    class="bg-gradient-to-br from-indigo-950 via-purple-950 to-zinc-950 flex items-center justify-center min-h-screen px-4">
    <div class="sm:w-sm">
        {{ $slot }}
    </div>
    <script src="{{ asset('assets/script.js') }}"></script>
</body>

</html>
