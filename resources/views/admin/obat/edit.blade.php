@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4 text-warning">✏️ Edit Obat</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan input:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('obat.update', $obat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Kode Barang -->
        <div class="mb-3">
            <label class="form-label">Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" value="{{ old('kode_barang', $obat->kode_barang) }}" required>
            @error('kode_barang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nama Barang -->
        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="barang" class="form-control @error('barang') is-invalid @enderror" value="{{ old('barang', $obat->barang) }}" required>
            @error('barang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori', $obat->kategori) }}" required>
            @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required>{{ old('deskripsi', $obat->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Stok -->
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $obat->stok) }}" required>
            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
         <!-- Satuan -->
        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <textarea name="satuan" class="form-control @error('satuan') is-invalid @enderror" rows="2">{{ old('satuan', $obat->satuan) }}</textarea>
            @error('satuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga Pokok -->
        <div class="mb-3">
            <label class="form-label">Harga Pokok</label>
            <input type="number" name="harga_pokok" class="form-control @error('harga_pokok') is-invalid @enderror" value="{{ old('harga_pokok', $obat->harga_pokok) }}" required>
            @error('harga_pokok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga Jual -->
        <div class="mb-3">
            <label class="form-label">Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual', $obat->harga_jual) }}" required>
            @error('harga_jual')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Komposisi -->
        <div class="mb-3">
            <label class="form-label">Komposisi</label>
            <textarea name="komposisi" class="form-control @error('komposisi') is-invalid @enderror" rows="2">{{ old('komposisi', $obat->komposisi) }}</textarea>
            @error('komposisi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Foto -->
        <div class="mb-3">
            <label class="form-label">Foto Obat</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($obat->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/foto_obat/' . $obat->foto) }}" alt="Foto Obat {{ $obat->barang }}" width="120" class="img-thumbnail">
                </div>
            @endif
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('obat.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
