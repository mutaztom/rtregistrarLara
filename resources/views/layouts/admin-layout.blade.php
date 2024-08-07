<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->

    @bukStyles(true)
</head>

<body class="font-sans antialiased">
   

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.admin-navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @if (session('error'))
            <x-bladewind::alert type="error">
                {{ session('error') }}
            </x-bladewind::alert>
        @endif
        @if (session('success'))
            <x-bladewind::alert type="success">
                {{ session('success') }}
            </x-bladewind::alert>
        @endif
        <x-bladewind::notification />
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-bladewind::alert type="error">
                    {{ $error }}
                </x-bladewind::alert>
            @endforeach
        @endif
            {{ $slot }}
        </main>
    </div>
    @bukScripts(true)
</body>

</html>
