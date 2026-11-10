@extends('layouts.app')

@section('pageTitle', 'Data Pelanggan')


@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-6">
    <div>
        <h2 class="text-lg font-bold text-[#1F2937]">Data Pelanggan</h2>
        <p class="text-sm text-[#6B7280]">Kelola data pelanggan rental.</p>
    </div>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">Tambah Pelanggan</a>
</div>

@if ($errors->any())
    <div class="alert alert-error mb-6">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="GET" action="{{ route('customers.index') }}" class="flex flex-col sm:flex-row gap-3 mb-6">
    <input type="text" name="search" value="{{ $search ?? '' }}"
           placeholder="Cari kode, nama, atau telepon..." class="form-input flex-1 min-w-0">
    <button class="btn btn-secondary">Cari</button>
</form>

<div class="overflow-auto">
    <table class="table-standard">
        <thead>
            <tr>
                <th class="w-32 text-center">Kode</th>
                <th>Nama</th>
                <th class="w-48 text-center">Telepon</th>
                <th class="w-64">Alamat</th>
                <th class="w-40 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td class="font-medium text-center">{{ $customer->customer_code }}</td>
                    <td>{{ $customer->name }}</td>
                    <td class="text-center">{{ $customer->phone }}</td>
                    <td>{{ $customer->address ?? '-' }}</td>
                    <td class="text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('customers.destroy', $customer) }}"
                                  onsubmit="return confirm('Hapus pelanggan ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-state">Belum ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $customers->links() }}
</div>

<x-back-link :href="route('dashboard')" class="mt-6">Kembali ke Dashboard</x-back-link>
@endsection
