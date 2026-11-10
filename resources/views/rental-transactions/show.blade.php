@extends('layouts.app')

@section('pageTitle', 'Detail Transaksi Rental')


@section('content')
<div class="max-w-2xl mx-auto">
    <x-back-link :href="route('rental-transactions.index')">Kembali ke Daftar Transaksi</x-back-link>

    <div class="card p-6">
        <h2 class="text-lg font-bold text-[#1F2937] mb-4">Detail Transaksi Rental</h2>

        <dl class="space-y-4">
            <div>
                <dt class="text-sm text-[#6B7280]">Kode Transaksi</dt>
                <dd class="font-semibold">{{ $transaction->transaction_code }}</dd>
            </div>
            <div>
                <dt class="text-sm text-[#6B7280]">Pelanggan</dt>
                <dd>{{ $transaction->customer->name }}</dd>
            </div>
            <div>
                <dt class="text-sm text-[#6B7280]">Kendaraan</dt>
                <dd>{{ $transaction->vehicle->name }} ({{ $transaction->vehicle->plate_number }})</dd>
            </div>
            <div>
                <dt class="text-sm text-[#6B7280]">Tanggal Rental</dt>
                <dd>{{ $transaction->rental_date->format('d-m-Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm text-[#6B7280]">Rencana Kembali</dt>
                <dd>{{ $transaction->return_date->format('d-m-Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm text-[#6B7280]">Durasi Rental</dt>
                <dd>{{ $transaction->total_days }} hari</dd>
            </div>
            <div>
                <dt class="text-sm text-[#6B7280]">Harga per Hari</dt>
                <dd>Rp {{ number_format($transaction->price_per_day, 0, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm text-[#6B7280]">Total Biaya</dt>
                <dd class="text-lg font-bold text-[#1F2937]">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm text-[#6B7280]">Tanggal Pengembalian Aktual</dt>
                <dd>
                    {{ $transaction->actual_return_date ? $transaction->actual_return_date->format('d-m-Y') : '-' }}
                </dd>
            </div>
            <div>
                <dt class="text-sm text-[#6B7280]">Status</dt>
                <dd>
                    <span class="badge {{ $transaction->status === 'berjalan' ? 'badge-blue' : ($transaction->status === 'selesai' ? 'badge-green' : 'badge-gray') }}">{{ ucfirst($transaction->status) }}</span>
                </dd>
            </div>
        </dl>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('rental-transactions.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
            <a href="{{ route('rental-transactions.edit', $transaction) }}" class="btn btn-secondary">Ubah</a>

            @if ($transaction->status === 'berjalan')
                <form action="{{ route('rental-transactions.return', $transaction) }}" method="POST"
                      onsubmit="return confirm('Proses pengembalian kendaraan ini?')">
                    @csrf
                    <button type="submit" class="btn btn-primary">Proses Pengembalian</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
