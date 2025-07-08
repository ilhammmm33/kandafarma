@extends('layouts.app')

@section('content')
<style>
    @media (max-width: 768px) {
        .form-label {
            font-size: 0.9rem;
        }

        .btn {
            font-size: 0.9rem;
        }

        .row.g-3 > .col-md-6,
        .row.g-3 > .col-md-4,
        .row.g-3 > .col-md-2 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        #obatListContainer .row {
            border-bottom: 1px dashed #ccc;
            padding-bottom: 15px;
            margin-bottom: 10px;
        }

        #templateObatRow .row {
            margin-bottom: 0 !important;
        }
    }
</style>

<div class="container">
    <h3 class="fw-bold text-primary mb-4">🧾 Transaksi Kasir - Multi Obat</h3>

    @if (session('success'))
        <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
    @endif

    <form action="{{ route('kasir.store') }}" method="POST" id="formTransaksi">
        @csrf

        <div id="obatListContainer"></div>

        <div class="d-grid gap-2 mb-4">
            <button type="button" class="btn btn-outline-primary" onclick="tambahObat()">+ Tambah Obat</button>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Total Harga</label>
            <input type="text" id="totalHarga" class="form-control bg-light" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Uang Tunai</label>
            <input type="number" id="uangTunai" class="form-control" min="0" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Kembalian</label>
            <input type="text" id="kembalian" class="form-control bg-light" readonly>
        </div>

        <button class="btn btn-primary w-100 rounded-3"><i class="bi bi-cart-check"></i> Simpan Transaksi</button>
    </form>
</div>

{{-- Template baris obat untuk ditambahkan secara dinamis --}}
<div id="templateObatRow" class="d-none">
    <div class="row g-3 align-items-end mb-3">
        <div class="col-12 col-md-6">
            <label class="form-label">Obat</label>
            <select name="obat_id[]" class="form-select obat-select" onchange="hitungTotal()">
                <option value="">-- Pilih Obat --</option>
                @foreach ($obatList as $obat)
                    <option value="{{ $obat->id }}">
                        {{ $obat->barang }} - Rp{{ number_format((float)$obat->harga_jual, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah[]" class="form-control jumlah-input" value="1" min="1" onchange="hitungTotal()">
        </div>
        <div class="col-12 col-md-2">
            <label class="form-label d-md-none d-block invisible">Hapus</label>
            <button type="button" class="btn btn-danger w-100" onclick="hapusObat(this)">🗑️</button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Data harga obat dalam format JS
    const obatData = @json($obatList->pluck('harga_jual', 'id'));

    // Tambahkan baris obat dari template
    function tambahObat() {
        const container = document.getElementById('obatListContainer');
        const template = document.getElementById('templateObatRow');
        if (template) {
            const clone = template.firstElementChild.cloneNode(true);
            container.appendChild(clone);
            hitungTotal();
        }
    }

    // Hapus baris obat
    function hapusObat(el) {
        el.closest('.row').remove();
        hitungTotal();
    }

    // Hitung total harga dan kembalian
    function hitungTotal() {
        let total = 0;
        const selects = document.querySelectorAll('.obat-select');
        const jumlahs = document.querySelectorAll('.jumlah-input');

        selects.forEach((select, i) => {
            const id = select.value;
            const jumlah = parseInt(jumlahs[i].value) || 0;
            const harga_jual = obatData[id] || 0;
            total += harga_jual * jumlah;
        });

        document.getElementById('totalHarga').value = 'Rp' + total.toLocaleString('id-ID');

        const tunai = parseInt(document.getElementById('uangTunai').value) || 0;
        const kembali = tunai - total;
        document.getElementById('kembalian').value = kembali >= 0 ? 'Rp' + kembali.toLocaleString('id-ID') : '-';
    }

    // Hitung ulang saat input uang tunai berubah
    document.getElementById('uangTunai').addEventListener('input', hitungTotal);

    // Tambah baris pertama saat halaman dibuka
    window.addEventListener('DOMContentLoaded', tambahObat);
</script>
@endsection
