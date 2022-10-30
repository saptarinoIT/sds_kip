<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        // $alternatif = Alternatif::all();
        $alternatif = [];
        // $kode_krit = [];
        // foreach ($kriteria as $krit) {
        //     $kode_krit[$krit->id] = [];
        //     foreach ($krit->nilai as $crip) {
        //         if ($crip->kriteria->id == $krit->id) {
        //             $kode_krit[$krit->id][] = $crip->nilai;
        //         }
        //     }
        //     $kode_krit[$krit->id] = min($kode_krit[$krit->id]);
        // };
        return view('peringkat.index', [
            'kriteria'      => $kriteria,
            'alternatif'    => $alternatif,
            // 'kode_krit'     => $kode_krit
        ]);
    }

    public function filter(Request $request)
    {
        if ($request->jenjang) {
            $reqJen = $request->input('jenjang');
            $reqThn = $request->input('tahun');
            if ($request->tahun) {

                // $kriteria = Kriteria::whereHas('nilai', function (Builder $query) use ($reqJen, $reqThn) {
                //       $query->whereHas('alternatif', function($query) use ($reqJen, $reqThn)  {
                //         $query->where('jenjang', $reqJen)->where('tahun', $reqThn);
                //    });
                // })->get();
                $kriteria = Kriteria::whereHas('nilai', function ($query) use ($reqJen, $reqThn) {
                    $query->whereHas('alternatif', function ($query) use ($reqJen, $reqThn) {
                        $query->where('jenjang', $reqJen)->where('tahun', $reqThn);
                    });
                })->with(['nilai' => function ($q) use ($reqJen, $reqThn) {
                    $q->whereHas('alternatif', function ($query) use ($reqJen, $reqThn) {
                        $query->where('jenjang', $reqJen)->where('tahun', $reqThn);
                    });
                }])
                    ->get();

                $alternatif = Alternatif::where('jenjang', $reqJen)->where('tahun', $reqThn)->get();
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
}
