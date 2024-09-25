<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\kriteria;

class KriteriaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data['kriteria'] = kriteria::orderBy('nama_kriteria', 'ASC')->get();
        return view('admin.kriteria.index', $data);
    }

    public function store(Request $request){
        $this->validate($request,[ // tambahal all() jika error
            'nama_kriteria' => 'required|string',
            'atribut'       => 'required|string',
            'bobot'         => 'required|numeric'
        ]);

        try {
            $kriteria = new kriteria();
            $kriteria->nama_kriteria = $request->nama_kriteria;
            $kriteria->attribut = $request->atribut;
            $kriteria->bobot = $request->bobot;
            $kriteria->save();
            return back()->with('msg', 'Berhasil menambahkan data');
        } catch (Exception $e) {
            \Log::emergency("File: " . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            die("Gagal");
        }
    }

    public function edit($id){
        $data['kriteria'] = kriteria::findOrFail($id);
        return view('admin.kriteria.edit', $data);
    }

    public function update(Request $request, $id){
        $this->validate($request, [ // tambahal all() jika error
            'nama_kriteria' => 'required|string',
            'atribut'       => 'required|string',
            'bobot'         => 'required|numeric'
        ]);

        try {
            $kriteria = kriteria::findOrFail($id);
            $kriteria->update([
                'nama_kriteria' => $request->nama_kriteria,
                'attribut'      => $request->atribut,
                'bobot'         => $request->bobot
            ]);
            return back()->with('msg', 'Berhasil merubah data');
        } catch (Exception $e) {
            \Log::emergency("File: " . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            die("Gagal");
        }
    }

    public function destroy($id){
        try {
            $kriteria = kriteria::findOrFail($id);
            $kriteria->delete();
        } catch (Exception $e) {
            \Log::emergency("File: " . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            die("Gagal");
        }
    }
}
