<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @auth
        <div class="h-screen w-screen flex overflow-hidden select-none">
            <sidebar></sidebar>
            <main class="pb-2 px-5 flex-1 bg-gray-100 dark:bg-black overflow-y-auto">
              <div class="flex flex-col capitalize text-2xl">
                <span class="font-semibold">hello,</span>
                <span>{{ Auth::user()->name }}</span>
              </div>    
        @endauth
                <div class="my-4">
                    @yield('content')
                </div>
            @auth
                </main>
            </div>
        </div>
        @endauth
</body>
</html>
