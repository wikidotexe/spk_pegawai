<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penilaian;
use App\Models\alternatif;

class PenilaianController extends Controller
{
    public function index () {
        $alternatif = alternatif::with('penilaian.crips')->get();
        return view('admin.penilaian.index', compact('alternatif'));
    }
}
