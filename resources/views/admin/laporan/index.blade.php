@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-3 mt-5">📈 Statistik Penjualan</h4>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="mb-3 fw-semibold">Harian (7 Hari)</h6>
                    <canvas id="chartHarian"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="mb-3 fw-semibold">Bulanan (12 Bulan)</h6>
                    <canvas id="chartBulanan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="mb-3 fw-semibold">Tahunan (5 Tahun)</h6>
                    <canvas id="chartTahunan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <h3 class="fw-bold text-primary mb-4">📑 Laporan Penjualan & Obat Tidak Laku</h3>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-select">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ sprintf('%02d', $i) }}" {{ $bulan == sprintf('%02d', $i) ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tahun</label>
            <select name="tahun" class="form-select">
                @for ($y = now()->year; $y >= 2022; $y--)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3 align-self-end">
            <button class="btn btn-primary"><i class="bi bi-search"></i> Tampilkan</button>
        </div>
    </form>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card border-start border-success border-4 shadow-sm">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h2>{{ $rekap->total_transaksi ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-start border-primary border-4 shadow-sm">
                <div class="card-body">
                    <h5>Total Obat Terjual</h5>
                    <h2>{{ $rekap->total_obat ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-start border-warning border-4 shadow-sm">
                <div class="card-body">
                    <h5>Total Pendapatan</h5>
                    <h2>Rp{{ number_format($rekap->total_pendapatan ?? 0) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold">🧊 Obat Tidak Laku</h5>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($obatTidakLaku as $obat)
                <tr>
                    <td>{{ $obat->barang }}</td>
                    <td>{{ $obat->kategori }}</td>
                    <td>{{ $obat->stok }}</td>
                    <td>Rp{{ number_format((float)$obat->harga_jual) }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-muted">Semua obat sudah pernah terjual.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- 💡 Rekomendasi AI --}}
    @if (!empty($rekomendasi) && count($rekomendasi) > 0)
        <div class="alert alert-info mt-4">
            <h5 class="fw-bold">🤖 Rekomendasi Promosi Obat (AI)</h5>
            <p>Obat berikut memiliki stok tinggi namun belum terjual dalam 2 bulan terakhir:</p>
            <ul class="mb-0">
                @foreach ($rekomendasi as $obat)
                    <li>{{ $obat->barang }} (Stok: {{ $obat->stok }}, Harga Jual: Rp{{ number_format($obat->harga_jual) }})</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const harian = @json($statHarian);
    const bulanan = @json($statBulanan);
    const tahunan = @json($statTahunan);

    new Chart(document.getElementById('chartHarian'), {
        type: 'line',
        data: {
            labels: harian.map(h => h.tanggal),
            datasets: [{
                label: 'Pendapatan Harian',
                data: harian.map(h => h.total),
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.2)',
                fill: true
            }]
        }
    });

    new Chart(document.getElementById('chartBulanan'), {
        type: 'bar',
        data: {
            labels: bulanan.map(b => b.bulan),
            datasets: [{
                label: 'Pendapatan Bulanan',
                data: bulanan.map(b => b.total),
                backgroundColor: 'rgba(40, 167, 69, 0.6)'
            }]
        }
    });

    new Chart(document.getElementById('chartTahunan'), {
        type: 'line',
        data: {
            labels: tahunan.map(t => t.tahun),
            datasets: [{
                label: 'Pendapatan Tahunan',
                data: tahunan.map(t => t.total),
                borderColor: '#fd7e14',
                backgroundColor: 'rgba(253,126,20,0.3)',
                fill: true
            }]
        }
    });
</script>
@endsection
