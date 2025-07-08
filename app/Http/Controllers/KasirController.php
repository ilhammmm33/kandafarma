<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class KasirController extends Controller
{
    public function index()
    {
        $obatList = Obat::all(); // Ambil semua data obat
        return view('admin.kasir.index', compact('obatList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|array',
            'jumlah'  => 'required|array',
        ]);

        $transaksi = Transaksi::create([
            'total_harga' => 0,
            'jumlah'      => array_sum($request->jumlah),
        ]);

        $total = 0;

        foreach ($request->obat_id as $i => $id) {
            $obat = Obat::find($id);

            if (!$obat) {
                return back()->with('error', 'Obat tidak ditemukan');
            }

            $jumlah = $request->jumlah[$i];
            $subtotal = $jumlah * $obat->harga_jual;

            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'obat_id'      => $id,
                'jumlah'       => $jumlah,
                'harga_jual'   => $obat->harga_jual,
                'subtotal'     => $subtotal,
            ]);

            $obat->stok -= $jumlah;
            $obat->save();

            $total += $subtotal;
        }

        $transaksi->update(['total_harga' => $total]);

        return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function riwayat(Request $request)
    {
        $query = Transaksi::with('details.obat')->orderBy('created_at', 'desc');

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $transaksis = $query->get();
        return view('admin.kasir.riwayat', compact('transaksis'));
    }

    public function destroy($id)
    {
        $trx = Transaksi::with('details.obat')->findOrFail($id);

        // Kembalikan stok
        foreach ($trx->details as $detail) {
            $detail->obat->increment('stok', $detail->jumlah);
        }

        // Hapus detail terlebih dahulu jika diperlukan (cascade bisa diatur di DB)
        $trx->details()->delete();
        $trx->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan.');
    }

    public function nota($id)
    {
        $trx = Transaksi::with('details.obat')->findOrFail($id);
        return view('admin.kasir.nota', compact('trx'));
    }
}
