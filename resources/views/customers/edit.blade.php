@extends('layouts.app')

@section('pageTitle', 'Edit Pelanggan')


@section('content')
<div class="max-w-2xl mx-auto">
    <x-back-link :href="route('customers.index')">Kembali ke Data Pelanggan</x-back-link>

    <div class="card p-6">
        <h2 class="text-lg font-bold text-[#1F2937] mb-4">Edit Pelanggan</h2>

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

        <form action="{{ route('customers.update', $customer) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="customer_code" class="form-label">Kode Pelanggan <span class="required">*</span></label>
                <input id="customer_code" name="customer_code" type="text" required maxlength="20"
                       value="{{ old('customer_code', $customer->customer_code) }}" class="form-input">
                @error('customer_code')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Nama Pelanggan <span class="required">*</span></label>
                <input id="name" name="name" type="text" required maxlength="100"
                       value="{{ old('name', $customer->name) }}" class="form-input">
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Nomor Telepon <span class="required">*</span></label>
                <input id="phone" name="phone" type="text" required maxlength="20"
                       value="{{ old('phone', $customer->phone) }}" class="form-input">
                @error('phone')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="identity_number" class="form-label">Nomor Identitas</label>
                <input id="identity_number" name="identity_number" type="text" maxlength="30"
                       value="{{ old('identity_number', $customer->identity_number) }}" class="form-input">
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Alamat</label>
                <textarea id="address" name="address" rows="3"
                          class="form-textarea">{{ old('address', $customer->address) }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
