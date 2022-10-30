<?php

namespace App\Http\Controllers;

use App\Models\Atribut;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class AtributController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atribut = Atribut::all();
        return view('kriteria.atribut.index', compact('atribut'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('kriteria.atribut.create', compact('kriteria'));
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
            'kode' => 'required',
            'nama' => 'required',
            'nilai' => 'required',
        ]);
        $subkri = new Atribut();
        $subkri->kriteria_id = $request->kode;
        $subkri->nama_atribut = $request->nama;
        $subkri->nilai_atribut = $request->nilai;
        $subkri->save();

        return redirect()->route('atribut.index')->with(['success' => 'Data Berhasil Ditambahkan.']);
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
        $sub = Atribut::findOrFail($id);
        $kriteria = Kriteria::all();
        return view('kriteria.atribut.edit', compact('sub', 'kriteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'nilai' => 'required',
        ]);
        $subkri = Atribut::findOrFail($id);
        $subkri->kriteria_id = $request->kode;
        $subkri->nama_atribut = $request->nama;
        $subkri->nilai_atribut = $request->nilai;
        $subkri->save();

        return redirect()->route('atribut.index')->with(['success' => 'Data Berhasil Dirubah.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = Atribut::findOrFail($id);
        $sub->delete();

        return redirect()->route('atribut.index')->with(['success' => 'Data Berhasil Dihapus.']);
    }
}
