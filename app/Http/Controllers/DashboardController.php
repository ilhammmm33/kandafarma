<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $totalObat = Obat::count();
        $transaksiHariIni = Transaksi::whereDate('created_at', today())->count();
        $pendapatanHariIni = Transaksi::whereDate('created_at', today())->sum('total_harga');
        $obatHampirHabis = Obat::where('stok', '<=', 10)->count();

        $statHarian = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('admin.dashboard', compact(
            'totalObat', 'transaksiHariIni', 'pendapatanHariIni', 'obatHampirHabis', 'statHarian'
        ));
    }

}
