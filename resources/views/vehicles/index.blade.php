@extends('layouts.app')

@section('pageTitle', 'Data Kendaraan')


@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-6">
    <div>
        <h2 class="text-lg font-bold text-[#1F2937]">Data Kendaraan</h2>
        <p class="text-sm text-[#6B7280]">Kelola data kendaraan rental.</p>
    </div>
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Tambah Kendaraan</a>
</div>

<form method="GET" action="{{ route('vehicles.index') }}" class="flex flex-col sm:flex-row gap-3 mb-6">
    <input type="text" name="search" value="{{ $search ?? '' }}"
           placeholder="Cari nama, kode, atau plat nomor..." class="form-input flex-1 min-w-0">
    <button class="btn btn-secondary">Cari</button>
</form>

<div class="overflow-auto">
    <table class="table-standard">
        <thead>
            <tr>
                <th class="w-24 text-center">Kode</th>
                <th>Nama</th>
                <th class="w-40">Kategori</th>
                <th class="w-40 text-center">Plat Nomor</th>
                <th class="w-32 text-right">Harga/Hari</th>
                <th class="w-32 text-center">Status</th>
                <th class="w-40 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vehicles as $vehicle)
                <tr>
                    <td class="font-medium text-center">{{ $vehicle->code }}</td>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->category->name }}</td>
                    <td class="text-center">{{ $vehicle->plate_number }}</td>
                    <td class="text-right">Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <span class="badge {{ $vehicle->status === 'tersedia' ? 'badge-green' : 'badge-blue' }}">{{ ucfirst($vehicle->status) }}</span>
                    </td>
                    <td class="text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('vehicles.destroy', $vehicle) }}"
                                  class="inline" onsubmit="return confirm('Hapus kendaraan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-state">Belum ada data kendaraan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $vehicles->links() }}
</div>
@endsection
