@php
    $appName = config('app.name', 'Sistem Rental Kendaraan');

    $pageTitle = trim($__env->yieldContent('pageTitle'));

    if ($pageTitle === '') {
        $pageTitle = match (true) {
            request()->routeIs('dashboard') => 'Dashboard',
            request()->routeIs('profile.*') => 'Profil',
            request()->routeIs('categories.*') => 'Kategori',
            request()->routeIs('customers.*') => 'Pelanggan',
            request()->routeIs('vehicles.*') => 'Kendaraan',
            request()->routeIs('rental-transactions.*') => 'Transaksi Rental',
            default => 'Dashboard',
        };
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $pageTitle }} - {{ $appName }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-100">

            @include('layouts.navigation')

            <div class="flex min-h-[calc(100vh-4rem)] flex-col">
                <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                    <div class="mx-auto w-full max-w-7xl">

                        {{-- Notifikasi dari session --}}
                        @if (session('success'))
                            <div class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="alert">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mb-5 flex items-start gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        @if (session('info'))
                            <div class="mb-5 flex items-start gap-3 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800" role="alert">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                <span>{{ session('info') }}</span>
                            </div>
                        @endif

                        {{-- Isi halaman --}}
                        @isset($slot)
                            {{ $slot }}
                        @else
                            @yield('content')
                        @endisset
                    </div>
                </main>

                <footer class="border-t border-slate-200 bg-white py-4">
                    <div class="mx-auto w-full max-w-7xl px-4 text-center text-xs text-slate-500 sm:px-6 lg:px-8">
                        &copy; {{ date('Y') }} {{ $appName }}
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
