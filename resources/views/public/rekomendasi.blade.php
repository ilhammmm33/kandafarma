@extends('layouts.public')

@section('content')

<h3 class="fw-bold mb-4 d-flex justify-content-between align-items-center">
    🧠 Pilih Gejala Anda
    <a href="{{ route('public.home') }}" class="btn btn-outline-dark rounded-pill">
        <i class="bi bi-house-door me-1"></i> Beranda
    </a>
</h3>

<form method="POST" action="{{ route('public.rekomendasi.proses') }}">
    @csrf
    <div class="row g-3">
        @foreach ($gejalas as $gejala)
            <div class="col-md-4">
                <label class="w-100 position-relative">
                    <input type="checkbox" class="btn-check" name="gejala_id[]" value="{{ $gejala->id }}" id="g{{ $gejala->id }}">
                    <div class="btn btn-outline-primary w-100 text-start shadow-sm p-3 rounded-4 d-flex align-items-center">
                        <i class="bi bi-heart-pulse fs-4 me-3 text-danger"></i>
                        <span class="fw-semibold">{{ ucfirst($gejala->nama_gejala) }}</span>
                    </div>
                </label>
            </div>
        @endforeach
    </div>

    <div class="text-end mt-4">
        <button class="btn btn-success btn-lg rounded-pill shadow-sm">
            🔍 Lihat Rekomendasi
        </button>
    </div>
</form>
@endsection
