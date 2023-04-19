<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | BackOffice </title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="">
    <div class="container-fluid p-0">
        @include("layouts.partials.navbar")

        
        <main class="container">
            <div>
                <h2 class="mt-3">
                    @yield('title')
                </h2>
            
                @yield('actions')
            </div>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @yield('modals')

    @yield('scripts')
</body>
</html>
