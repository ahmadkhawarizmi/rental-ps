@extends('layouts.app')

@section('pageTitle', 'Transaksi Rental')


@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-6">
    <div>
        <h2 class="text-lg font-bold text-[#1F2937]">Transaksi Rental</h2>
        <p class="text-sm text-[#6B7280]">Daftar penyewaan kendaraan.</p>
    </div>
    <a href="{{ route('rental-transactions.create') }}" class="btn btn-primary">Tambah Transaksi</a>
</div>

@if (session('success'))
    <div class="alert alert-success mb-6">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-error mb-6">{{ session('error') }}</div>
@endif
@if (session('info'))
    <div class="alert alert-info mb-6">{{ session('info') }}</div>
@endif

<div class="overflow-auto">
    <table class="table-standard">
        <thead>
            <tr>
                <th class="w-40 text-center">Kode Transaksi</th>
                <th class="w-40">Pelanggan</th>
                <th class="w-40">Kendaraan</th>
                <th class="w-32 text-center">Tanggal Rental</th>
                <th class="w-32 text-center">Tanggal Kembali</th>
                <th class="w-32 text-right">Total Biaya</th>
                <th class="w-32 text-center">Status</th>
                <th class="w-40 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td class="font-medium text-center">{{ $transaction->transaction_code }}</td>
                    <td>{{ $transaction->customer->name }}</td>
                    <td>{{ $transaction->vehicle->name }}</td>
                    <td class="text-center">{{ $transaction->rental_date->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $transaction->return_date->format('d-m-Y') }}</td>
                    <td class="text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <span class="badge {{ $transaction->status === 'berjalan' ? 'badge-blue' : ($transaction->status === 'selesai' ? 'badge-green' : 'badge-gray') }}">{{ ucfirst($transaction->status) }}</span>
                    </td>
                    <td class="text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('rental-transactions.show', $transaction) }}" class="btn btn-sm btn-secondary">Detail</a>
                            <a href="{{ route('rental-transactions.edit', $transaction) }}" class="btn btn-sm btn-secondary">Ubah</a>
                            @if ($transaction->status !== 'berjalan')
                                <form action="{{ route('rental-transactions.destroy', $transaction) }}" method="POST"
                                      class="inline" onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty-state">Belum ada transaksi rental.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $transactions->links() }}
</div>

<x-back-link :href="route('dashboard')" class="mt-6">Kembali ke Dashboard</x-back-link>
@endsection
