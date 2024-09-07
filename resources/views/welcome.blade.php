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


    <header class="min-h-48">
        <div class="flex flex-row w-full pt-8 pb-8 pl-8 text-blue-800 font-bold">
            <div class="w-4/5 ">
                <!-- Add your responsive navigation bar here -->
                @include('layouts.navbar')
            </div>
            <div class="w-2/5 place-content-end justify-items-end">
                <div class="flex flex-row-reverse gap-3 ">
                    <x-bladewind::dropmenu name="signup">
                        <x-slot:trigger>
                            <x-bladewind::icon name="user-circle"/>
                            Singup/Login
                        </x-slot:trigger>
                        <x-bladewind::dropmenu-item>
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                                {{ __('Sign Up') }}
                            </a>
                        </x-bladewind::dropmenu-item>
                        <x-bladewind::dropmenu-item>
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                                {{ __('Login') }}
                            </a>
                        </x-bladewind::dropmenu-item>
                    </x-bladewind::dropmenu>
                    <div>
                        <!-- Add your language switcher or links here -->
                        @include('layouts.language-switcher')
                    </div>
                </div>
            </div>
        </div>
        <p>
            {{ session('locale') }}
        </p>
    </header>

    <!-- Page Content -->
    <main>
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50" style="margin-top: 25px;">
            <div
                class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">


                    <div class="flex base-1/2">
                        <!-- Add your dynamic content or images here -->
                        <img src={{ URL::asset('img/ec_soon.jpg') }} alt="Coming Soon" />
                    </div>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        RationalTeam Registrar v 2.0 For Sudan Engineering Council
                    </footer>
                </div>
            </div>
        </div>
</body>

</html>
