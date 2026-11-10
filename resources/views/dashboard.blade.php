<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Rental System
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-800">
                    Selamat Datang, Administrator!
                </h3>
                <p class="text-gray-600 mt-1">
                    Berikut ringkasan data sistem rental kendaraan.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total Kategori -->
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-purple-500">
                    <p class="text-gray-500 text-sm">Total Kategori</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalCategories }}
                    </h3>
                </div>

                <!-- Total Pelanggan -->
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">Total Pelanggan</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalCustomers }}
                    </h3>
                </div>

                <!-- Total Kendaraan -->
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">Total Kendaraan</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalVehicles }}
                    </h3>
                </div>

                <!-- Total Transaksi -->
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-orange-500">
                    <p class="text-gray-500 text-sm">Total Transaksi</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalTransactions }}
                    </h3>
                </div>

            </div>

            <div class="mt-8 bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    Informasi Sistem
                </h3>
                <p class="text-gray-600">
                    Gunakan menu navigasi di atas untuk mengelola kategori,
                    pelanggan, kendaraan, dan transaksi penyewaan.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
