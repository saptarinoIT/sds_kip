<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Atribut;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $daftarKri = Kriteria::all();
        return view('kriteria.index', compact('daftarKri'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "kode" => "required",
            "nama" => "required",
            "nilai" => "required"
        ]);
        $kriteria = new Kriteria();
        $kriteria->kode_kriteria = strtolower(htmlspecialchars($request->kode));
        $kriteria->nama_kriteria = strtolower(htmlspecialchars($request->nama));
        $kriteria->bobot = (htmlspecialchars($request->nilai) / 100);
        $kriteria->save();
        return redirect()->route('kriteria.index')->with(['success' => 'Data Berhasil Ditambahkan.']);
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'nilai' => 'required|numeric'
        ]);
        $newKriteria = (htmlspecialchars($request->nilai) / 100);
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update([
            'kode_kriteria' => strtolower(htmlspecialchars($request->kode)),
            'nama_kriteria' => strtolower(htmlspecialchars($request->nama)),
            'bobot' => $newKriteria,
        ]);
        return redirect()->route('kriteria.index')->with(['success' => 'Data Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $kri = Kriteria::findOrFail($id);
        $sub = Atribut::where('kriteria_id', $kri->id);
        $sub->delete();
        $kri->delete();
        return redirect()->route('kriteria.index')->with(['success' => 'Data Berhasil Dihapus.']);
    }
}
