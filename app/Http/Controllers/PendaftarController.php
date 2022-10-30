<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    public function index()
    {
        $alternatif = [];
        $kriteria = Kriteria::all();
        return view('pendaftar.index', compact('alternatif', 'kriteria'));
    }

    public function filter(Request $request, Alternatif $alternatif)
    {
        $kriteria = Kriteria::all();
        if ($request->jenjang) {

            if ($request->tahun) {
                $alternatif = $alternatif->where('jenjang', $request->input('jenjang'))
                    ->where('tahun', $request->input('tahun'))
                    ->get();
                return view('pendaftar.index', compact('alternatif', 'kriteria'));
            }

            $alternatif = $alternatif->where('jenjang', $request->input('jenjang'))->get();
            return view('pendaftar.index', compact('alternatif', 'kriteria'));
        } elseif ($request->tahun) {
            $alternatif = $alternatif->where('tahun', $request->input('tahun'))
                ->get();
            return view('pendaftar.index', compact('alternatif', 'kriteria'));
        }

        $alternatif = Alternatif::all();
        return view('pendaftar.index', compact('alternatif', 'kriteria'));
    }

    public function create()
    {
        $kelurahan = array(
            array('nama' => 'belimbing'),
            array('nama' => 'kanaan'),
            array('nama' => 'telihan'),
            array('nama' => 'berbas pantai'),
            array('nama' => 'berbas tengah'),
            array('nama' => 'berbas lestari'),
            array('nama' => 'satimpo'),
            array('nama' => 'tanjung laut'),
            array('nama' => 'tanjung laut indah'),
            array('nama' => 'api api'),
            array('nama' => 'bontang baru'),
            array('nama' => 'bontang kuala'),
            array('nama' => 'guntung'),
            array('nama' => 'gunung elai'),
            array('nama' => 'loktuan'),
        );
        $kri = Kriteria::all();
        return view('pendaftar.create', compact('kelurahan', 'kri'));
    }

    public function store(Request $request)
    {
        $c2 = $request->peng_ayah + $request->peng_ibu + $request->peng_wali;
        $c5 = $request->pangan + $request->sandang + $request->pdam + $request->listrik + $request->internet + $request->pulsa + $request->transportasi + $request->cicilan + $request->sewa_rumah;
        $tahun = date('Y');

        $alternatif = Alternatif::where('jenjang', $request->jenjang)->where('tahun', $tahun)->orderBy('id', 'desc')->first();
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
        $newAlternatif->user_id = $request->user_id;
        $newAlternatif->kode_alternatif = $nama;
        $newAlternatif->jenjang = $request->jenjang;
        $newAlternatif->nama = $request->nama;
        $newAlternatif->alamat = $request->alamat . ', rt.' . $request->rt . ', ' . $request->kelurahan;
        $newAlternatif->asal_sekolah = $request->asal_sekolah;
        $newAlternatif->universitas = $request->universitas;
        $newAlternatif->fakultas = $request->fakultas;
        $newAlternatif->jurusan = $request->jurusan;
        $newAlternatif->nama_ayah = $request->nama_ayah;
        $newAlternatif->nama_ibu = $request->nama_ibu;
        $newAlternatif->nama_wali = $request->nama_wali;
        $newAlternatif->pek_ayah = $request->pek_ayah;
        $newAlternatif->pek_ibu = $request->pek_ibu;
        $newAlternatif->pek_wali = $request->pek_wali;
        $newAlternatif->peng_ayah = $request->peng_ayah;
        $newAlternatif->peng_ibu = $request->peng_ibu;
        $newAlternatif->peng_wali = $request->peng_wali;
        $newAlternatif->pangan = $request->pangan;
        $newAlternatif->sandang = $request->sandang;
        $newAlternatif->pdam = $request->pdam;
        $newAlternatif->listrik = $request->listrik;
        $newAlternatif->internet = $request->internet;
        $newAlternatif->pulsa = $request->pulsa;
        $newAlternatif->transportasi = $request->transportasi;
        $newAlternatif->cicilan = $request->cicilan;
        $newAlternatif->sewa_rumah = $request->sewa_rumah;
        $newAlternatif->keterangan = $request->keterangan;
        $newAlternatif->tahun = $tahun;
        $newAlternatif->save();

        $kri = Kriteria::all();
        foreach ($kri as $i => $k) {
            $nor = new NilaiAlternatif();
            $nor->alternatif_id = $newAlternatif->id;
            $nor->kriteria_id = $k->id;
            if ($i == 1) {
                $nor->nilai = $c2;
            } elseif ($i == 4) {
                $nor->nilai = $c5;
            } else {
                $nilai = $_POST['c' . $i + 1];
                $nor->nilai = (int)$nilai;
            }
            $nor->save();
        }

        return redirect()->route('pendaftar.index')->with(['success' => 'Data Berhasil Ditambahkan.']);
    }

    public function show($id)
    {
        $pendaftar = Alternatif::findOrFail($id);
        return view('pendaftar.show', compact('pendaftar'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $pendaftar = Alternatif::findOrFail($id);
        $pendaftar->delete();

        return redirect()->route('pendaftar.index')->with(['success' => 'Data Berhasil Dihapuskan.']);
    }
}
