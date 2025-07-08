@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="fw-bold text-primary">📈 Statistik Penjualan</h4>

    <h5 class="mt-4">📅 Harian (7 Hari Terakhir)</h5>
    <ul>
        @foreach($harian as $h)
        <li>{{ $h->tanggal }}: Rp{{ number_format($h->total) }}</li>
        @endforeach
    </ul>

    <h5 class="mt-4">📆 Mingguan (4 Minggu Terakhir)</h5>
    <ul>
        @foreach($mingguan as $m)
        <li>Minggu {{ $m->minggu }}: Rp{{ number_format($m->total) }}</li>
        @endforeach
    </ul>

    <h5 class="mt-4">🗓️ Bulanan (12 Bulan Terakhir)</h5>
    <ul>
        @foreach($bulanan as $b)
        <li>{{ $b->bulan }}: Rp{{ number_format($b->total) }}</li>
        @endforeach
    </ul>

    <h5 class="mt-4">📅 Tahunan (5 Tahun Terakhir)</h5>
    <ul>
        @foreach($tahunan as $t)
        <li>{{ $t->tahun }}: Rp{{ number_format($t->total) }}</li>
        @endforeach
    </ul>
</div>
@endsection
