<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArsipSuratController extends Controller {
    public function index(Request $request) {
        $query = ArsipSurat::with('kategori');

        // Fitur pencarian berdasarkan judul
        if ($request->has('search') && !empty($request->search)) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $arsip = $query->latest()->get();
        return view('arsip.index', compact('arsip'));
    }

    public function create() {
        $kategori = KategoriSurat::all();
        return view('arsip.create', compact('kategori'));
    }

    public function store(Request $request) {
        $request->validate([
            'nomor_surat' => 'required|unique:arsip_surat',
            'kategori_id' => 'required',
            'judul' => 'required',
            'file_pdf' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file_pdf')->store('arsip', 'public');

        ArsipSurat::create([
            'nomor_surat' => $request->nomor_surat,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'file_pdf' => $file,
        ]);

        return redirect()->route('arsip.index')->with('success','Data berhasil disimpan');
    }

    public function show(ArsipSurat $arsip) {
        $arsip->load('kategori');
        return view('arsip.show', compact('arsip'));
    }

    public function edit(ArsipSurat $arsip) {
        $kategori = KategoriSurat::all();
        return view('arsip.edit', compact('arsip','kategori'));
    }

    public function update(Request $request, ArsipSurat $arsip) {
        $request->validate([
            'nomor_surat' => 'required|unique:arsip_surat,nomor_surat,' . $arsip->id,
            'kategori_id' => 'required',
            'judul' => 'required',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only('nomor_surat', 'kategori_id','judul');
        if($request->hasFile('file_pdf')) {
            if($arsip->file_pdf && Storage::disk('public')->exists($arsip->file_pdf)) {
                Storage::disk('public')->delete($arsip->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('arsip', 'public');
        }

        $arsip->update($data);
        return redirect()->route('arsip.index')->with('success','Data berhasil diperbarui');
    }

    public function destroy(ArsipSurat $arsip) {
        if($arsip->file_pdf && Storage::disk('public')->exists($arsip->file_pdf)) {
            Storage::disk('public')->delete($arsip->file_pdf);
        }
        $arsip->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    /**
     * Download PDF file
     */
    public function download(ArsipSurat $arsip) {
        if ($arsip->file_pdf && Storage::disk('public')->exists($arsip->file_pdf)) {
            $pathToFile = storage_path('app/public/' . $arsip->file_pdf);
            return response()->download($pathToFile);
        }

        abort(404, 'File tidak ditemukan');
    }
}
