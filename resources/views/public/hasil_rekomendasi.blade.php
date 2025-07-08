@extends('layouts.public')

@section('content')
<h3 class="fw-bold mb-4 d-flex justify-content-between align-items-center">
    🔎 Hasil Rekomendasi Obat
    <a href="{{ route('public.rekomendasi') }}" class="btn btn-outline-dark rounded-pill">
        <i class="bi bi-arrow-left me-1"></i> Pilih Gejala Lagi
    </a>
</h3>

<!-- Tambahan: Menampilkan gejala yang dipilih -->
@if (!empty($selectedGejalas))
<div class="alert alert-info shadow-sm mb-4">
    <i class="bi bi-info-circle me-2"></i>
    <strong>Gejala yang Anda pilih:</strong>
    <div class="mt-2">
        @foreach ($selectedGejalas as $gejala)
            <span class="badge bg-primary me-2 mb-1">{{ ucfirst($gejala->nama_gejala) }}</span>
        @endforeach
    </div>
</div>
@endif

@if ($obats->count())
<div class="row g-4">
    @foreach ($obats as $obat)
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 hover-shadow">
            @if ($obat->foto)
            <img src="{{ asset('storage/foto_obat/' . $obat->foto) }}"
                class="card-img-top object-fit-cover rounded-top-4"
                style="height: 180px; object-fit: cover;"
                alt="{{ $obat->barang }}">
            @endif

            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">{{ $obat->barang }}</h5>
                <p class="mb-1"><strong>Kategori:</strong> {{ $obat->kategori }}</p>
                <p class="mb-1"><strong>Stok:</strong> {{ $obat->stok }}</p>
                <p class="fw-bold text-success"><i class="bi bi-cash"></i> Rp{{ number_format($obat->harga) }}</p>
                <div class="mt-2">
                    <span class="badge bg-info text-dark">
                        Gejala: {{ $obat->gejalas->pluck('nama_gejala')->implode(', ') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="alert alert-warning shadow-sm">
    <i class="bi bi-exclamation-circle me-2"></i> Tidak ditemukan obat yang cocok berdasarkan gejala yang Anda pilih.
</div>
@endif
@endsection