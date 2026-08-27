<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Dashboard') — LIMS Lite</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="relative min-h-screen overflow-x-hidden font-sans text-[#0f172a] antialiased">

        <div class="relative z-10 flex min-h-screen">
            @include('partials.sidebar')

            <div class="flex min-w-0 flex-1 flex-col">
                @include('partials.topbar')

                <main class="flex-1 px-4 pb-10 pt-6 sm:px-6 lg:px-8">
                    @yield('content')
                </main>

                @include('partials.footer')
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
