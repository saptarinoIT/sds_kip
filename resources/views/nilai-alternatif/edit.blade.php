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
    <li class="breadcrumb-item text-white opacity-75 small">Nilai Alternatif</li>
  </ul>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="card-title flex-column">
      <h2 class="mb-1">Ubah Nilai Alternatif</h2>
    </div>

  </div>

  <!--begin::Card body-->
  <div class="card-body py-4">

    <form action="{{ route('nilai-alternatif.update', $alternatif->id) }}" method="POST">
      @csrf
      @method('PATCH')
      @foreach ($kriteria as $i => $k)
      @if ($k->atribut->isEmpty())
      <div class="mb-5">
        <label class="form-label">{{ ucwords($k->nama_kriteria) }}</label>
        <input type="number" name="{{ $k->kode_kriteria }}" class="form-control" value="{{ $arrayKri[$i] }}" />
      </div>
      @else
      <div class="mb-3">
        <label class="form-label">{{ ucwords($k->nama_kriteria) }}</label>
        <select class="form-select" name="{{ $k->kode_kriteria }}">
          <option value="">-- Pilih {{$k->nama_kriteria}}--</option>
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
