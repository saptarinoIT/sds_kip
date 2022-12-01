@extends('layout.app')


@section('panelhead')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="d-flex text-white fw-bolder my-1 fs-3">Data Siswa</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-white opacity-75">
                <a href="." class="text-white text-hover-primary small">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-white opacity-75 small">Data Siswa</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h2 class="mb-1">Tambah Data Siswa</h2>
            </div>

        </div>

        <!--begin::Card body-->
        <div class="card-body py-4">

            <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label class="form-label">Kode Alternatif</label>
                    <input class="form-control" type="text" value="{{ $alternatif->kode_alternatif }}" readonly required>
                    <input class="form-control" name="id_alternatif" type="hidden" value="{{ $alternatif->id }}" readonly
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <input class="form-control" type="text" value="{{ strtoupper($alternatif->jurusan) }}" readonly
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input class="form-control" type="text" value="{{ $alternatif->tahun }}" readonly required>
                </div>

                @foreach ($kri as $i => $k)
                    @if ($k->atribut->isEmpty())
                        <div class="mb-5">
                            <label class="form-label">{{ ucwords($k->nama_kriteria) }}</label>
                            <input type="number" name="{{ $k->kode_kriteria }}" class="form-control" />
                        </div>
                    @else
                        <div class="mb-3">
                            <label class="form-label">{{ ucwords($k->nama_kriteria) }}</label>
                            <select class="form-select" name="{{ $k->kode_kriteria }}">
                                <option value="">-- Pilih {{ $k->nama_kriteria }}--</option>
                                @foreach ($k->atribut as $sub)
                                    <option value="{{ $sub->nilai_atribut }}">{{ strtoupper($sub->nama_atribut) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                @endforeach

                <button type="submit" class="btn btn-sm btn-primary">Simpan Data</button>
            </form>

        </div>

    </div>
@endsection
