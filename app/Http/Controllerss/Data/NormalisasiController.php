<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use App\Models\NormalisasiModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class NormalisasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dataPendaftar = [];
        return view('nilai-alternatif.index', compact('dataPendaftar'));
    }

    public function filter(Request $request, NilaiAlternatif $normal)
    {
        if ($request->jurusan) {
            $reqJen = $request->input('jurusan');
            $reqThn = $request->input('tahun');
            if ($request->tahun) {

                $kriteria = Kriteria::all();
                // $dataPendaftar = $normal->whereHas('alternatif', function (Builder  $query) use ($reqJen, $reqThn) {
                //     return $query->where('jurusan', $reqJen)->where('tahun', $reqThn);
                // })->get();
                $alternatif = Alternatif::where('jurusan', $reqJen)->where('tahun', $reqThn)->get();

                return view('nilai-alternatif.index', compact('alternatif', 'kriteria'));
            }

            $kriteria = Kriteria::all();
            $alternatif = $normal->whereHas('alternatif', function (Builder  $query) use ($reqJen) {
                return $query->where('jurusan', $reqJen);
            })->get();
            return view('nilai-alternatif.index', compact('alternatif', 'kriteria'));
        } elseif ($request->tahun) {

            $kriteria = Kriteria::all();
            $alternatif = $normal->where('tahun', $request->input('tahun'))
                ->get();
            return view('nilai-alternatif.index', compact('alternatif', 'kriteria'));
        }

        $kriteria = Kriteria::all();
        $alternatif = NilaiAlternatif::all();
        return view('nilai-alternatif.index', compact('alternatif', 'kriteria'));
    }
}
