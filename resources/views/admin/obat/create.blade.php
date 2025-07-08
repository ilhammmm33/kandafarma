@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4 text-primary">➕ Tambah Obat Baru</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada beberapa kesalahan input:
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('obat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" value="{{ old('kode_barang') }}" required>
            @error('kode_barang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="barang" class="form-control @error('barang') is-invalid @enderror" value="{{ old('barang') }}" required>
            @error('barang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori') }}" required>
            @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" required>
            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror">
            @error('satuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Harga Pokok</label>
            <input type="number" name="harga_pokok" class="form-control @error('harga_pokok') is-invalid @enderror" value="{{ old('harga_pokok') }}" required>
            @error('harga_pokok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual') }}" required>
            @error('harga_jual')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Komposisi</label>
            <textarea name="komposisi" class="form-control @error('komposisi') is-invalid @enderror" rows="2">{{ old('komposisi') }}</textarea>
            @error('komposisi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Obat</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('obat.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
