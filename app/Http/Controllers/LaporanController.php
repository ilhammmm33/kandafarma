<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->format('m');
        $tahun = $request->tahun ?? now()->format('Y');

        // Rekap data penjualan
        $rekap = TransaksiDetail::whereHas('transaksi', function ($query) use ($bulan, $tahun) {
                $query->whereMonth('created_at', $bulan)
                      ->whereYear('created_at', $tahun);
            })
            ->selectRaw('SUM(jumlah) as total_obat')
            ->selectRaw('SUM(jumlah * harga_jual) as total_pendapatan')
            ->selectRaw('COUNT(DISTINCT transaksi_id) as total_transaksi')
            ->first();

        // Obat yang tidak laku (tidak terjual di bulan ini)
        $obatTerjualIds = TransaksiDetail::whereHas('transaksi', function ($query) use ($bulan, $tahun) {
                $query->whereMonth('created_at', $bulan)
                      ->whereYear('created_at', $tahun);
            })->pluck('obat_id')->unique();

        $obatTidakLaku = Obat::whereNotIn('id', $obatTerjualIds)->get();

        // Rekomendasi AI: Obat stok tinggi dan tidak laku 2 bulan terakhir
        $rekomendasi = [];
        foreach ($obatTidakLaku as $obat) {
            $jumlahTerjual2Bulan = TransaksiDetail::where('obat_id', $obat->id)
                ->where('created_at', '>=', Carbon::now()->subMonths(2))
                ->sum('jumlah');

            if ($jumlahTerjual2Bulan == 0 && $obat->stok > 10) {
                $rekomendasi[] = $obat;
            }
        }

        // Statistik Penjualan
        $statHarian = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $statBulanan = Transaksi::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan, SUM(total_harga) as total")
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $statTahunan = Transaksi::selectRaw("YEAR(created_at) as tahun, SUM(total_harga) as total")
            ->where('created_at', '>=', now()->subYears(5))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        return view('admin.laporan.index', compact(
            'rekap', 'obatTidakLaku', 'rekomendasi',
            'bulan', 'tahun', 'statHarian', 'statBulanan', 'statTahunan'
        ));
    }

    public function statistik()
    {
        $harian = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $mingguan = Transaksi::selectRaw('YEARWEEK(created_at) as minggu, SUM(total_harga) as total')
            ->where('created_at', '>=', now()->subWeeks(4))
            ->groupBy('minggu')
            ->orderBy('minggu')
            ->get();

        $bulanan = Transaksi::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan, SUM(total_harga) as total")
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $tahunan = Transaksi::selectRaw("YEAR(created_at) as tahun, SUM(total_harga) as total")
            ->where('created_at', '>=', now()->subYears(5))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        return view('admin.laporan.statistik', compact('harian', 'mingguan', 'bulanan', 'tahunan'));
    }

    public function obatMenurun()
    {
        $bulanIni = now()->format('m');
        $bulanLalu = now()->subMonth()->format('m');
        $tahun = now()->year;

        $penjualanBulanIni = TransaksiDetail::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahun)
            ->select('obat_id', DB::raw('SUM(jumlah) as total'))
            ->groupBy('obat_id')
            ->pluck('total', 'obat_id');

        $penjualanBulanLalu = TransaksiDetail::whereMonth('created_at', $bulanLalu)
            ->whereYear('created_at', $tahun)
            ->select('obat_id', DB::raw('SUM(jumlah) as total'))
            ->groupBy('obat_id')
            ->pluck('total', 'obat_id');

        $obatMenurun = [];

        foreach ($penjualanBulanLalu as $obat_id => $total_lalu) {
            $total_ini = $penjualanBulanIni[$obat_id] ?? 0;
            if ($total_ini < $total_lalu) {
                $obat = Obat::find($obat_id);
                if ($obat) {
                    $obatMenurun[] = [
                        'obat' => $obat,
                        'bulan_ini' => $total_ini,
                        'bulan_lalu' => $total_lalu,
                    ];
                }
            }
        }

        return view('admin.laporan.obat_menurun', compact('obatMenurun'));
    }
}
