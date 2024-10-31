<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\crips;
use App\Models\kriteria;

class CripsController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'nama_crips' => 'required|string',
            'bobot'      => 'required|numeric'
        ]);

        try {
            $crips = new crips();
            $crips->kriteria_id = $request->kriteria_id;
            $crips->nama_crips = $request->nama_crips;
            $crips->bobot = $request->bobot;
            $crips->save();
            return back()->with('msg', 'Berhasil menambahkan data');
        } catch (Exception $e) {
            \Log::emergency("File: " . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            die("Gagal menghapus data");
        }
    }

    public function edit($id){
        $data['crips'] = crips::findOrFail($id);

        return view('admin.crips.edit', $data);
    }

    public function update(Request $request, $id){

        try {
            $crips = crips::findOrFail($id);
            $crips->update([
                'nama_crips'    =>  $request->nama_crips,
                'bobot'         =>  $request->bobot
            ]);
            return back()->with('msg', 'Berhasil merubah data');
        } catch (Exception $e) {
            \Log::emergency("File: " . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            die("Gagal menghapus data");
        }
    }

    public function destroy($id){
        try {
            $crips = crips::findOrFail($id);
            $crips->delete();
        } catch (Exception $e) {
            \Log::emergency("File: " . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            die("Gagal menghapus data");
        }
    }
}
