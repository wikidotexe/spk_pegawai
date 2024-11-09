<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penilaian;
use App\Models\alternatif;
use App\Models\kriteria;
use DB;

class PenilaianController extends Controller
{
    public function index() {
        $alternatif = alternatif::with('penilaian.crips')->get();
        $kriteria = kriteria::with('crips')->orderBy('nama_kriteria', 'ASC')->get();
        return view('admin.penilaian.index', compact('alternatif', 'kriteria'));
    }

    public function store(Request $request) {
        try {
            DB::select('TRUNCATE penilaian');
            foreach ($request->crips_id as $alternatif_id => $crips_ids) {
                foreach ($crips_ids as $crips_id) {
                    penilaian::create([
                        'alternatif_id' => $alternatif_id,
                        'crips_id'      => $crips_id
                    ]);
                }
            }
            return back()->with('msg', 'Berhasil disimpan');
        } catch (Exception $e) {
            \Log::emergency("File: " . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            die("Gagal menghapus data");
        }
    }
}
