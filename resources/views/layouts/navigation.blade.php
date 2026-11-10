<nav x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-40 border-b border-slate-200 bg-white">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">

            {{-- Logo aplikasi --}}
            <div class="flex min-w-0 items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex shrink-0 items-center gap-2.5">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-navy-900 text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 16.5v-4l1.75-4.25h11.5L19.5 12.5v4" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 16.5h15" />
                            <circle cx="7.5" cy="16.5" r="1.5" />
                            <circle cx="16.5" cy="16.5" r="1.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.5h15" />
                        </svg>
                    </span>

                    <span class="leading-tight">
                        <span class="block text-sm font-semibold text-slate-900">Sistem Rental</span>
                        <span class="block text-xs text-slate-500">Kendaraan</span>
                    </span>
                </a>

                {{-- Menu desktop --}}
                <div class="hidden items-center gap-1 lg:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        Kategori
                    </x-nav-link>

                    <x-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')">
                        Pelanggan
                    </x-nav-link>

                    <x-nav-link :href="route('vehicles.index')" :active="request()->routeIs('vehicles.*')">
                        Kendaraan
                    </x-nav-link>

                    <x-nav-link :href="route('rental-transactions.index')" :active="request()->routeIs('rental-transactions.*')">
                        Transaksi Rental
                    </x-nav-link>
                </div>
            </div>

            {{-- Menu pengguna desktop --}}
            <div class="hidden lg:block">
                <x-dropdown align="right" width="w-56">
                    <x-slot name="trigger">
                        <button type="button"
                                class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-sm text-slate-600 transition-colors hover:bg-slate-100">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-navy-900 text-xs font-semibold text-white">
                                {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                            </span>

                            <span class="max-w-[10rem] truncate font-medium text-slate-700">
                                {{ Auth::user()->name }}
                            </span>

                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border-b border-slate-100 px-4 py-3">
                            <p class="truncate text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                            <p class="truncate text-xs text-slate-500">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Tombol menu mobile --}}
            <button type="button"
                    @click="mobileMenuOpen = ! mobileMenuOpen"
                    class="-mr-2 rounded-lg p-2 text-slate-600 transition-colors hover:bg-slate-100 lg:hidden"
                    aria-label="Buka menu">
                <svg x-show="! mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div x-cloak
         x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="border-t border-slate-200 bg-white lg:hidden">

        <div class="space-y-1 px-4 py-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                Kategori
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')">
                Pelanggan
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('vehicles.index')" :active="request()->routeIs('vehicles.*')">
                Kendaraan
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('rental-transactions.index')" :active="request()->routeIs('rental-transactions.*')">
                Transaksi Rental
            </x-responsive-nav-link>
        </div>

        <div class="border-t border-slate-200 px-4 py-4">
            <div class="mb-3 flex items-center gap-3 rounded-lg bg-slate-50 px-3 py-2.5">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-navy-900 text-sm font-semibold text-white">
                    {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                </span>

                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="truncate text-xs text-slate-500">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
                    Profil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
