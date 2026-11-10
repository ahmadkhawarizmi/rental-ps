@extends('layouts.app')

@section('pageTitle', 'Edit Kendaraan')


@section('content')
<div class="max-w-2xl mx-auto">
    <x-back-link :href="route('vehicles.index')">Kembali ke Data Kendaraan</x-back-link>

    <div class="card p-6">
        <h2 class="text-lg font-bold text-[#1F2937] mb-4">Edit Kendaraan</h2>

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

        <form action="{{ route('vehicles.update', $vehicle) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="category_id" class="form-label">Kategori <span class="required">*</span></label>
                <select id="category_id" name="category_id" required class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id', $vehicle->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="code" class="form-label">Kode Kendaraan <span class="required">*</span></label>
                <input id="code" name="code" type="text" required maxlength="30"
                       value="{{ old('code', $vehicle->code) }}" class="form-input">
                @error('code')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Nama Kendaraan <span class="required">*</span></label>
                <input id="name" name="name" type="text" required maxlength="100"
                       value="{{ old('name', $vehicle->name) }}" class="form-input">
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="brand" class="form-label">Merek</label>
                <input id="brand" name="brand" type="text" maxlength="100"
                       value="{{ old('brand', $vehicle->brand) }}" class="form-input">
            </div>

            <div class="form-group">
                <label for="plate_number" class="form-label">Plat Nomor <span class="required">*</span></label>
                <input id="plate_number" name="plate_number" type="text" required maxlength="20"
                       value="{{ old('plate_number', $vehicle->plate_number) }}" class="form-input">
                @error('plate_number')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="price_per_day" class="form-label">Harga Sewa per Hari (Rp) <span class="required">*</span></label>
                <input id="price_per_day" name="price_per_day" type="number" required min="0" step="0.01"
                       value="{{ old('price_per_day', $vehicle->price_per_day) }}" class="form-input">
                @error('price_per_day')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status <span class="required">*</span></label>
                <select id="status" name="status" required class="form-select">
                    <option value="tersedia" @selected(old('status', $vehicle->status) == 'tersedia')>Tersedia</option>
                    <option value="disewa" @selected(old('status', $vehicle->status) == 'disewa')>Disewa</option>
                </select>
                @error('status')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description" rows="3"
                          class="form-textarea">{{ old('description', $vehicle->description) }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
