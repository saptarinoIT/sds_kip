<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Atribut;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = [];
        return view('alternatif.index', compact('alternatif'));
    }

    public function filter(Request $request, Alternatif $alternatif)
    {
        if ($request->jurusan) {

            if ($request->tahun) {
                $alternatif = $alternatif->where('jurusan', $request->input('jurusan'))
                    ->where('tahun', $request->input('tahun'))
                    ->get();
                return view('alternatif.index', compact('alternatif'));
            }

            $alternatif = $alternatif->where('jurusan', $request->input('jurusan'))->get();
            return view('alternatif.index', compact('alternatif'));
        } elseif ($request->tahun) {
            $alternatif = $alternatif->where('tahun', $request->input('tahun'))
                ->get();
            return view('alternatif.index', compact('alternatif'));
        }

        $alternatif = Alternatif::all();
        return view('alternatif.index', compact('alternatif'));
    }

    public function create()
    {
        $kri = Kriteria::all();
        return view('alternatif.create', compact('kri'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'jurusan' => 'required|in:sd,smp,sma',
            'tahun' => 'required',
        ]);
        $alternatif = Alternatif::where('jurusan', $request->jurusan)->where('tahun', $request->tahun)->orderBy('id', 'desc')->first();
        if ($alternatif  != null) {
            $result = substr("$alternatif->kode_alternatif", -3) + 1;
            if ($result >= 100) {
                $nama = (strtoupper($request->jurusan) . $result);
            } else if ($result >= 10) {
                $nama = (strtoupper($request->jurusan) . '0' . $result);
            } else if ($result < 10) {
                $nama = (strtoupper($request->jurusan) . '00' . $result);
            } else {
                $nama = (strtoupper($request->jurusan) . "001");
            }
        } else {
            $nama = (strtoupper($request->jurusan) . "001");
        }
        $newAlternatif = new Alternatif();
        $newAlternatif->kode_alternatif = $nama;
        $newAlternatif->jurusan = $request->jurusan;
        $newAlternatif->tahun = $request->tahun;
        $newAlternatif->save();

        $kri = Kriteria::all();
        foreach ($kri as $i => $k) {
            $nor = new NilaiAlternatif();
            $nor->alternatif_id = $newAlternatif->id;
            $nor->kriteria_id = $k->id;
            $nor->nilai = $_POST['c' . $i + 1];
            $nor->save();
        }

        return redirect()->route('alternatif.index')->with(['success' => 'Data Berhasil Ditambahkan.']);
    }

    public function show($id)
    {
        //
    }

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

    public function destroy($id)
    {
        $sub = Alternatif::findOrFail($id);
        $sub->delete();

        return redirect()->route('alternatif.index')->with(['success' => 'Data Berhasil Dihapus.']);
    }
}
