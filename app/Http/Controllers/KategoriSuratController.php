<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class KategoriSuratController extends Controller {
    public function index(Request $request) {
        $query = KategoriSurat::withCount('arsip');

        // Fitur pencarian berdasarkan nama kategori
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $kategori = $query->get();
        return view('kategori.index', compact('kategori'));
    }

    public function create() {
        // Mendapatkan ID berikutnya yang akan digunakan
        $nextId = KategoriSurat::max('id') + 1;
        return view('kategori.create', compact('nextId'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'nullable',
        ]);
        KategoriSurat::create($request->all());
        return redirect()->route('kategori.index')->with('success','Kategori berhasil ditambah');
    }

    public function edit(KategoriSurat $kategori) {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriSurat $kategori) {
        $request->validate([
            'nama_kategori' => 'required',
        ]);
        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success','Kategori berhasil diupdate');
    }

    public function destroy(KategoriSurat $kategori) {
        $kategori->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
