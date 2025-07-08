<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $obats = Obat::query()
            ->when($search, function ($query, $search) {
                return $query->where('id', $search)
                            ->orWhere('kode_barang', 'like', "%{$search}%")
                            ->orWhere('barang', 'like', "%{$search}%");
            })
            ->paginate(20);

        return view('admin.obat.index', compact('obats'));
    }

    // Metode lain (create, store, edit, update, destroy) tetap sama
    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:obats,kode_barang',
            'barang' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
            'satuan' => 'required',
            'harga_pokok' => 'required|integer',
            'harga_jual' => 'required|integer',
            'komposisi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['kode_barang', 'barang', 'kategori', 'deskripsi', 'stok', 'satuan', 'harga_pokok', 'harga_jual', 'komposisi']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_obat', $namaFile);
            $data['foto'] = $namaFile;
        }

        Obat::create($data);
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan');
    }

    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'kode_barang' => 'required|unique:obats,kode_barang,' . $obat->id,
            'barang' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
            'harga_pokok' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['kode_barang', 'barang', 'kategori', 'deskripsi', 'stok', 'satuan', 'harga_pokok', 'harga_jual', 'komposisi']);

        if ($request->hasFile('foto')) {
            if ($obat->foto && Storage::exists('public/foto_obat/' . $obat->foto)) {
                Storage::delete('public/foto_obat/' . $obat->foto);
            }

            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_obat', $namaFile);
            $data['foto'] = $namaFile;
        }

        $obat->update($data);
        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui');
    }

    public function destroy(Obat $obat)
    {
        if ($obat->foto && Storage::exists('public/foto_obat/' . $obat->foto)) {
            Storage::delete('public/foto_obat/' . $obat->foto);
        }

        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus');
    }
}