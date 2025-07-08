@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h4 class="fw-bold text-primary mb-2">📦 Data Obat</h4>
        <a href="{{ route('obat.create') }}" class="btn btn-primary rounded-pill">
            <i class="bi bi-plus-circle me-1"></i> Tambah Obat
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Form Pencarian -->
    <div class="mb-4">
        <form action="{{ route('obat.index') }}" method="GET" class="d-flex flex-wrap gap-2">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan ID, Kode, atau Nama Barang" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Cari</button>
            </div>
            <a href="{{ route('obat.index') }}" class="btn btn-secondary">Reset</a>
        </form>
    </div>

    {{-- Tabel Desktop --}}
    <div class="table-responsive shadow-sm border rounded d-none d-md-block">
        <table class="table table-striped align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Barang</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Harga Pokok</th>
                    <th>Harga Jual</th>
                    <th>Komposisi</th>
                    <th>Foto</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($obats as $obat)
                    <tr>
                        <td>{{ $obat->id }}</td>
                        <td>{{ $obat->kode_barang }}</td>
                        <td>{{ $obat->barang }}</td>
                        <td>{{ $obat->kategori }}</td>
                        <td>{{ $obat->deskripsi }}</td>
                        <td>{{ $obat->stok }}</td>
                        <td>{{ $obat->satuan }}</td>
                        <td>Rp{{ number_format((float)$obat->harga_pokok) }}</td>
                        <td>Rp{{ number_format((float)$obat->harga_jual) }}</td>
                        <td>{{ $obat->komposisi }}</td>
                        <td>
                            @if($obat->foto)
                                <img src="{{ asset('storage/foto_obat/' . $obat->foto) }}" class="img-thumbnail" style="height: 60px; width: 60px; object-fit: cover;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="12" class="text-muted">Belum ada data obat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tampilan Card untuk Mobile --}}
    <div class="d-md-none">
        @forelse ($obats as $obat)
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="fw-bold text-primary mb-1">{{ $obat->barang }}</h5>
                <p class="mb-1"><strong>Kategori:</strong> {{ $obat->kategori }}</p>
                <p class="mb-1"><strong>Deskripsi:</strong> {{ $obat->deskripsi }}</p>
                <p class="mb-1"><strong>Stok:</strong> {{ $obat->stok }} {{ $obat->satuan }}</p>
                <p class="mb-1"><strong>Harga Jual:</strong> Rp{{ number_format((float)$obat->harga_jual) }}</p>
                <p class="mb-1"><strong>Komposisi:</strong> {{ $obat->komposisi }}</p>
                @if($obat->foto)
                    <img src="{{ asset('storage/foto_obat/' . $obat->foto) }}" class="img-fluid rounded mt-2" style="height: 120px; object-fit: cover;" alt="{{ $obat->barang }}">
                @endif
                <div class="mt-3">
                    <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm btn-warning me-2"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <div class="text-muted text-center">Belum ada data obat.</div>
        @endforelse
    </div>

    <!-- Paginasi -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $obats->appends(['search' => request('search')])->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection