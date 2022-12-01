<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        // $alternatif = Alternatif::all();
        $alternatif = [];
        return view('nilai-alternatif.index', compact('alternatif', 'kriteria'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $selectKri = DB::table('nilai_alternatif')
        //     ->where('alternatif_id', $id)
        //     ->get();
        $selectKri = NilaiAlternatif::all();
        $alternatif = Alternatif::findOrFail($id);
        $kriteria = Kriteria::all();
        $arrayKri = [];
        foreach ($selectKri as $a) {
            array_push($arrayKri, $a->nilai);
        }
        return view('nilai-alternatif.edit', compact('kriteria', 'arrayKri', 'alternatif'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $kri = Kriteria::all();
        $nor = NilaiAlternatif::where('alternatif_id', $id)->get();
        foreach ($nor as $i => $k) {
            $k->nilai = $_POST['c' . $i + 1];
            $k->save();
        }

        return redirect()->route('nilai-alternatif.index')->with(['success' => 'Data Atribut Berhasil Ditambahkan.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
