<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Gejala;
use Illuminate\Support\Facades\Http;

class PublicController extends Controller
{
    public function index() {
        return view('public.home');
    }


    public function rekomendasi()
    {
        $gejalas = Gejala::all();
        return view('public.rekomendasi', compact('gejalas'));
    }

    public function prosesRekomendasi(Request $request)
    {
        $gejalaIds = $request->input('gejala_id', []);

        // Ambil obat yang punya minimal 1 dari gejala yang dipilih
        $obats = Obat::whereHas('gejalas', function ($query) use ($gejalaIds) {
            $query->whereIn('gejalas.id', $gejalaIds);
        })
        ->with('gejalas')
        ->get();

        return view('public.hasil_rekomendasi', compact('obats'));
    }

    public function stok(Request $request)
    {
        $query = \App\Models\Obat::query();

        if ($request->filled('search')) {
            $query->where('barang', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $kategoris = \App\Models\Obat::select('kategori')->distinct()->pluck('kategori');

        $obats = $query->get();

        return view('public.stok', compact('obats', 'kategoris'));
    }
    
}
