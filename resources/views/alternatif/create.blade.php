@extends('layout.app')


@section('panelhead')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="d-flex text-white fw-bolder my-1 fs-3">Data Alternatif</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-white opacity-75">
                <a href="." class="text-white text-hover-primary small">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-white opacity-75 small">Alternatif</li>
            <li class="breadcrumb-item">
                <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-white opacity-75 small">Tambah Data Alternatif</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h2 class="mb-1">Tambah Data Alternatif</h2>
            </div>

        </div>

        <!--begin::Card body-->
        <div class="card-body py-4">
            <form action="{{ route('alternatif.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select class="form-select" name="jurusan">
                        <option>Pilih salah satu ...</option>
                        <option value="ti">Teknik Informatika</option>
                        <option value="te">Teknik Elektro</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control" placeholder="{{ date('Y') }}"
                        value="{{ date('Y') }}" readonly
                        style="background-color: #eaeaea; border: none; color: #212121;" />
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
                                    <option value="{{ $sub->nilai_atribut }}">{{ strtoupper($sub->nama_atribut) }}</option>
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
