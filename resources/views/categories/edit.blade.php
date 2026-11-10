@extends('layouts.app')

@section('pageTitle', 'Edit Kategori')


@section('content')
<div class="max-w-2xl mx-auto">
    <x-back-link :href="route('categories.index')">Kembali ke Data Kategori</x-back-link>

    <div class="card p-6">
        <h2 class="text-lg font-bold text-[#1F2937] mb-4">Edit Kategori</h2>

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

        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Nama Kategori <span class="required">*</span></label>
                <input id="name" name="name" type="text" required maxlength="100"
                       value="{{ old('name', $category->name) }}" class="form-input">
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="form-textarea">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
