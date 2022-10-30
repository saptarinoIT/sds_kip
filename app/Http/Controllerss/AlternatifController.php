<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Atribut;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $alternatif = Alternatif::all();
        $alternatif = [];
        return view('alternatif.index', compact('alternatif'));
    }

    public function filter(Request $request, Alternatif $alternatif)
    {
        if ($request->jenjang) {

            if ($request->tahun) {
                $alternatif = $alternatif->where('jenjang', $request->input('jenjang'))
                    ->where('tahun', $request->input('tahun'))
                    ->get();
                return view('alternatif.index', compact('alternatif'));
            }

            $alternatif = $alternatif->where('jenjang', $request->input('jenjang'))->get();
            return view('alternatif.index', compact('alternatif'));
        } elseif ($request->tahun) {
            $alternatif = $alternatif->where('tahun', $request->input('tahun'))
                ->get();
            return view('alternatif.index', compact('alternatif'));
        }

        $alternatif = Alternatif::all();
        return view('alternatif.index', compact('alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alternatif.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenjang' => 'required|in:sd,smp,smaa',
            'tahun' => 'required',
        ]);
        $alternatif = Alternatif::where('jenjang', $request->jenjang)->where('tahun', $request->tahun)->orderBy('id', 'desc')->first();
        if ($alternatif  != null) {
            $result = substr("$alternatif->kode_alternatif", -3) + 1;
            if ($result >= 100) {
                $nama = (strtoupper($request->jenjang) . $result);
            } else if ($result >= 10) {
                $nama = (strtoupper($request->jenjang) . '0' . $result);
            } else if ($result < 10) {
                $nama = (strtoupper($request->jenjang) . '00' . $result);
            } else {
                $nama = (strtoupper($request->jenjang) . "001");
            }
        } else {
            $nama = (strtoupper($request->jenjang) . "001");
        }
        $newAlternatif = new Alternatif();
        $newAlternatif->kode_alternatif = $nama;
        $newAlternatif->jenjang = $request->jenjang;
        $newAlternatif->tahun = $request->tahun;
        $newAlternatif->save();

        return redirect()->route('alternatif.index')->with(['success' => 'Data Berhasil Ditambahkan.']);
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
        $alternatif = Alternatif::findOrFail($id);
        $kri = Kriteria::all();
        return view('alternatif.edit', compact('alternatif', 'kri'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $kri = Kriteria::all();
        foreach ($kri as $i => $k) {
            $nor = new NilaiAlternatif();
            $nor->alternatif_id = $request->id_alternatif;
            $nor->kriteria_id = $k->id;
            $nor->nilai = $_POST['c' . $i + 1];
            $nor->save();
        }
        // $data = array_values($request->except('_token', '_method'));
        // //        $data = Crip::find($data);
        // $alternatif = Alternatif::find($id);
        // $alternatif->atribut()->sync($data);

        return redirect()->route('alternatif.index')->with(['success' => 'Data Atribut Berhasil Ditambahkan.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = Alternatif::findOrFail($id);
        $sub->delete();

        return redirect()->route('alternatif.index')->with(['success' => 'Data Berhasil Dihapus.']);
    }
}
