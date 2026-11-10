@extends('layouts.app')

@section('pageTitle', 'Data Kategori')


@section('content')
@if (session('success'))
    <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-800 border border-green-200">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="mb-6 rounded-md bg-red-50 p-4 text-sm text-red-800 border border-red-200">
        {{ session('error') }}
    </div>
@endif
@if (session('info'))
    <div class="mb-6 rounded-md bg-blue-50 p-4 text-sm text-blue-800 border border-blue-200">
        {{ session('info') }}
    </div>
@endif

<div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-6">
    <div>
        <h2 class="text-lg font-bold text-[#1F2937]">Data Kategori</h2>
        <p class="text-sm text-[#6B7280]">Kelola kategori kendaraan rental.</p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
</div>

<form method="GET" action="{{ route('categories.index') }}" class="flex flex-col sm:flex-row gap-3 mb-6">
    <input type="text" name="search" value="{{ $search ?? '' }}"
           placeholder="Cari nama kategori..." class="form-input flex-1 min-w-0">
    <button class="btn btn-secondary">Cari</button>
</form>

<div class="overflow-auto">
    <table class="table-standard">
        <thead>
            <tr>
                <th class="w-20 text-center">No.</th>
                <th>Nama Kategori</th>
                <th class="w-80">Deskripsi</th>
                <th class="w-48 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td class="text-center text-[#6B7280]">{{ $categories->firstItem() + $loop->index }}</td>
                    <td class="font-medium">{{ $category->name }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td class="text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                  class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty-state">Belum ada kategori. Silakan tambahkan kategori baru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $categories->links() }}
</div>
@endsection
