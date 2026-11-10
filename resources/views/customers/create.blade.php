@extends('layouts.app')

@section('pageTitle', 'Tambah Pelanggan')


@section('content')
<div class="max-w-2xl mx-auto">
    <x-back-link :href="route('customers.index')">Kembali ke Data Pelanggan</x-back-link>

    <div class="card p-6">
        <h2 class="text-lg font-bold text-[#1F2937] mb-1">Tambah Pelanggan</h2>
        <p class="text-sm text-[#6B7280] mb-4">Isi data pelanggan di bawah ini.</p>

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

        <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="form-group">
                <label for="customer_code" class="form-label">Kode Pelanggan <span class="required">*</span></label>
                <input id="customer_code" name="customer_code" type="text" required maxlength="20"
                       value="{{ old('customer_code') }}" placeholder="PLG001" class="form-input">
                @error('customer_code')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Nama Pelanggan <span class="required">*</span></label>
                <input id="name" name="name" type="text" required maxlength="100"
                       value="{{ old('name') }}" class="form-input">
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Nomor Telepon <span class="required">*</span></label>
                <input id="phone" name="phone" type="text" required maxlength="20"
                       value="{{ old('phone') }}" class="form-input">
                @error('phone')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="identity_number" class="form-label">Nomor Identitas</label>
                <input id="identity_number" name="identity_number" type="text" maxlength="30"
                       value="{{ old('identity_number') }}" class="form-input">
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Alamat</label>
                <textarea id="address" name="address" rows="3"
                          class="form-textarea">{{ old('address') }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
