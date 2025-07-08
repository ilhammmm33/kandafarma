@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="fw-bold text-warning">📉 Obat dengan Penjualan Menurun</h4>

    @if(count($obatMenurun))
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Penjualan Bulan Lalu</th>
                    <th>Penjualan Bulan Ini</th>
                </tr>
            </thead>
            <tbody>
                @foreach($obatMenurun as $item)
                <tr>
                    <td>{{ $item['obat']->nama_obat }}</td>
                    <td>{{ $item['bulan_lalu'] }}</td>
                    <td>{{ $item['bulan_ini'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Tidak ada obat dengan penurunan penjualan.</p>
    @endif
</div>
@endsection
