@extends('layouts.app')

@section('pageTitle', 'Tambah Transaksi Rental')


@section('content')
<div class="max-w-2xl mx-auto">
    <x-back-link :href="route('rental-transactions.index')">Kembali ke Transaksi Rental</x-back-link>

    <div class="card p-6">
        <h2 class="text-lg font-bold text-[#1F2937] mb-1">Tambah Transaksi Rental</h2>
        <p class="text-sm text-[#6B7280] mb-4">Buat data penyewaan kendaraan baru.</p>

        @if ($errors->any())
            <div class="alert alert-error mb-4">
                <p class="text-sm font-medium mb-2">Mohon perbaiki kesalahan berikut:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($customers->isEmpty())
            <div class="alert alert-info mb-4">
                Belum ada pelanggan. Tambahkan pelanggan terlebih dahulu.
            </div>
        @endif

        @if ($vehicles->isEmpty())
            <div class="alert alert-info mb-4">
                Tidak ada kendaraan tersedia. Periksa data kendaraan dan statusnya.
            </div>
        @endif

        <form action="{{ route('rental-transactions.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="form-group">
                <label for="customer_id" class="form-label">Pelanggan <span class="required">*</span></label>
                <select id="customer_id" name="customer_id" required class="form-select">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                            {{ $customer->customer_code }} - {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="vehicle_id" class="form-label">Kendaraan <span class="required">*</span></label>
                <select id="vehicle_id" name="vehicle_id" required class="form-select">
                    <option value="">-- Pilih Kendaraan --</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" @selected(old('vehicle_id') == $vehicle->id)>
                            {{ $vehicle->code }} - {{ $vehicle->name }} (Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}/hari)
                        </option>
                    @endforeach
                </select>
                @error('vehicle_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="rental_date" class="form-label">Tanggal Mulai Rental <span class="required">*</span></label>
                <input id="rental_date" name="rental_date" type="date" required
                       value="{{ old('rental_date') }}" class="form-input">
                @error('rental_date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="return_date" class="form-label">Tanggal Rencana Kembali <span class="required">*</span></label>
                <input id="return_date" name="return_date" type="date" required
                       value="{{ old('return_date') }}" class="form-input">
                @error('return_date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    @disabled($customers->isEmpty() || $vehicles->isEmpty())
                    class="btn btn-primary disabled:opacity-50 disabled:cursor-not-allowed">
                    Simpan Transaksi
                </button>
                <a href="{{ route('rental-transactions.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
