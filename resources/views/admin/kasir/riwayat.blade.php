@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold text-primary mb-4">📜 Riwayat Transaksi Kasir</h3>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Form filter tanggal -->
    <form method="GET" action="{{ route('kasir.riwayat') }}" class="row g-3 mb-3 align-items-end">
        <div class="col-auto">
            <label for="tanggal" class="form-label">Filter Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control" required>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
            <a href="{{ route('kasir.riwayat') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-counterclockwise"></i> Reset
            </a>
        </div>
    </form>
    

    <!-- Tabel transaksi -->
    <div class="table-responsive border rounded shadow-sm">
        <table class="table table-bordered table-hover">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th width="160px">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($transaksis as $i => $trx)
            @foreach ($trx->details as $detail)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $detail->obat->barang ?? '-' }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp{{ number_format($detail->subtotal) }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('kasir.nota', $trx->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-printer"></i> Cetak
                            </a>
                            <form action="{{ route('kasir.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @empty
            <tr><td colspan="6" class="text-muted">Belum ada transaksi.</td></tr>
        @endforelse                    
            </tbody>
        </table>
    </div>
</div>
@endsection
