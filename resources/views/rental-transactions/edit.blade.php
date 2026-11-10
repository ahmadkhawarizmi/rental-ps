@extends('layouts.app')

@section('pageTitle', 'Ubah Transaksi Rental')


@section('content')
<div class="max-w-2xl mx-auto">
    <x-back-link :href="route('rental-transactions.index')">Kembali ke Transaksi Rental</x-back-link>

    <div class="card p-6">
        <h2 class="text-lg font-bold text-[#1F2937] mb-1">Ubah Transaksi Rental</h2>
        <p class="text-sm text-[#6B7280] mb-4">
            Kode Transaksi: <span class="font-semibold text-[#1F2937]">{{ $transaction->transaction_code }}</span>
            &middot; Status: <span class="font-semibold text-[#1F2937]">{{ ucfirst($transaction->status) }}</span>
        </p>

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

        @if (session('error'))
            <div class="alert alert-error mb-4">{{ session('error') }}</div>
        @endif

        <form action="{{ route('rental-transactions.update', $transaction) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="customer_id" class="form-label">Pelanggan <span class="required">*</span></label>
                <select id="customer_id" name="customer_id" required class="form-select">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"
                            @selected(old('customer_id', $transaction->customer_id) == $customer->id)>
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
                        <option value="{{ $vehicle->id }}"
                            @selected(old('vehicle_id', $transaction->vehicle_id) == $vehicle->id)>
                            {{ $vehicle->code }} - {{ $vehicle->name }} ({{ $vehicle->status }})
                        </option>
                    @endforeach
                </select>
                @error('vehicle_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
                <p class="text-[11px] text-[#6B7280] mt-1">Harga per hari diambil dari data kendaraan di database.</p>
            </div>

            <div class="form-group">
                <label for="rental_date" class="form-label">Tanggal Mulai Rental <span class="required">*</span></label>
                <input id="rental_date" name="rental_date" type="date" required
                       value="{{ old('rental_date', $transaction->rental_date->format('Y-m-d')) }}" class="form-input">
                @error('rental_date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="return_date" class="form-label">Tanggal Rencana Kembali <span class="required">*</span></label>
                <input id="return_date" name="return_date" type="date" required
                       value="{{ old('return_date', $transaction->return_date->format('Y-m-d')) }}" class="form-input">
                @error('return_date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('rental-transactions.show', $transaction) }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
