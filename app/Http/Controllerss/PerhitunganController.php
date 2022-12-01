<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        // $alternatif = Alternatif::all();
        $alternatif = [];
        $kode_krit = [];
        foreach ($kriteria as $krit) {
            $kode_krit[$krit->id] = [];
            foreach ($krit->nilai as $crip) {
                if ($crip->kriteria->id == $krit->id) {
                    $kode_krit[$krit->id][] = $crip->nilai;
                }
            }
            $kode_krit[$krit->id] = min($kode_krit[$krit->id]);
        };
        return view('peringkat.index', [
            'kriteria'      => $kriteria,
            'alternatif'    => $alternatif,
            'kode_krit'     => $kode_krit
        ]);
    }

    public function filter(Request $request)
    {
        if ($request->jurusan) {
            $reqJen = $request->input('jurusan');
            $reqThn = $request->input('tahun');
            if ($request->tahun) {

                // $kriteria = Kriteria::all();
                // $alternatif = Alternatif::where('jurusan', $reqJen)->where('tahun', $reqThn)->get();

                // return view('nilai-alternatif.index', compact('alternatif', 'kriteria'));
                $kriteria = Kriteria::all();
                // $alternatif = Alternatif::all();
                $alternatif = Alternatif::where('jurusan', $reqJen)->where('tahun', $reqThn)->get();
                $kode_krit = [];
                foreach ($kriteria as $krit) {
                    $kode_krit[$krit->id] = [];
                    foreach ($krit->nilai as $crip) {
                        if ($crip->kriteria->id == $krit->id) {
                            $kode_krit[$krit->id][] = $crip->nilai;
                        }
                    }
                    $kode_krit[$krit->id] = min($kode_krit[$krit->id]);
                };
                return view('peringkat.index', [
                    'kriteria'      => $kriteria,
                    'alternatif'    => $alternatif,
                    'kode_krit'     => $kode_krit
                ]);
            }

            $kriteria = Kriteria::all();
            $alternatif = Alternatif::all();
            $kode_krit = [];
            foreach ($kriteria as $krit) {
                $kode_krit[$krit->id] = [];
                foreach ($krit->nilai as $crip) {
                    if ($crip->kriteria->id == $krit->id) {
                        $kode_krit[$krit->id][] = $crip->nilai;
                    }
                }
                $kode_krit[$krit->id] = min($kode_krit[$krit->id]);
            };
            return view('peringkat.index', [
                'kriteria'      => $kriteria,
                'alternatif'    => $alternatif,
                'kode_krit'     => $kode_krit
            ]);
        }
    }
}
