<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\alternatif;

class AlternatifController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data['alternatif'] = alternatif::get();
        return view('admin.alternatif.index', $data);
    }

    public function store(Request $request){
        $this->validate($request,[ // tambahal all() jika error
            'nama_alternatif' => 'required|string',
        ]);

        try {
            $alternatif = new alternatif();
            $alternatif->nama_alternatif = $request->nama_alternatif;
            $alternatif->save();
            return back()->with('msg', 'Berhasil menambahkan data');
        } catch (Exception $e) {
            \Log::emergency("File: " . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            die("Gagal menambahkan data");
        }
    }

    public function edit($id){
        $data['alternatif'] = alternatif::findOrFail($id);
        return view('admin.alternatif.edit', $data);
    }

    public function update(Request $request, $id)
{
    // Validasi input
    $this->validate($request, [
        'nama_alternatif' => 'required|string|max:255',
    ]);

    try {
        $alternatif = alternatif::findOrFail($id);
        $alternatif->nama_alternatif = $request->nama_alternatif;
        $alternatif->save();
        return redirect()->route('alternatif.index')->with('msg', 'Data berhasil diupdate');
    } catch (Exception $e) {
        \Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
        return back()->with('msg', 'Gagal mengupdate data');
    }
}

    public function destroy($id){
        try {
            $alternatif = alternatif::findOrFail($id);
            $alternatif->delete();
        } catch (Exception $e) {
            \Log::emergency("File: " . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            die("Gagal menghapus data");
        }
    }
}