<!DOCTYPE html>
<html>
<head>
    <title>Nota Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="window.print()">
<div class="container mt-5">
    <h4 class="fw-bold text-center">Apotek Kanda Farma</h4>
    <hr>
    <p><strong>Waktu Transaksi:</strong> {{ $trx->created_at->format('d-m-Y H:i') }}</p>
    
    <p><strong>Barang:</strong></p>
    <ul>
        @foreach ($trx->details as $detail)
            <li>
                {{ $detail->obat->barang ?? 'Obat tidak tersedia' }} 
                ({{ $detail->jumlah }} x Rp{{ number_format($detail->harga_jual) }})
                = Rp{{ number_format($detail->subtotal) }}
            </li>
        @endforeach
    </ul>

    <p><strong>Jumlah Item:</strong> {{ $trx->jumlah }}</p>
    <p><strong>Total:</strong> Rp{{ number_format($trx->total_harga) }}</p>
    <hr>
    <p class="text-center">Terima kasih telah berbelanja!</p>
</div>
</body>
</html>
