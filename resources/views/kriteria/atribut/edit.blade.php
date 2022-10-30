@extends('layout.app')


@section('panelhead')
<div class="page-title d-flex flex-column me-3">
  <h1 class="d-flex text-white fw-bolder my-1 fs-3">Data Kriteria</h1>
  <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-white opacity-75">
      <a href="." class="text-white text-hover-primary small">Home</a>
    </li>
    <li class="breadcrumb-item">
      <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-white opacity-75 small">Kriteria</li>
    <li class="breadcrumb-item">
      <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-white opacity-75 small">Edit Nilai Atribut</li>
  </ul>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="card-title flex-column">
      <h2 class="mb-1">Edit Data Kriteria</h2>
    </div>

  </div>

  <!--begin::Card body-->
  <div class="card-body py-4">

    <form action="{{ route('atribut.update', $sub->id) }}" method="POST">
      @csrf
      @method('patch')
      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Kriteria</label>
        <div class="col-md-10">
          {{-- <input class="form-control form-control-solid @error('kode') is-invalid @enderror" autocomplete="off" id="kode" name="kode" type="text" required> --}}
          <select name="kode" id="kode" class="form-select @error('kode') is-invalid @enderror" required>
            <option>Pilih salah satu ...</option>
            @foreach ($kriteria as $item)
            <option value="{{ $item->id }}" {{ $item->id == $sub->kriteria_id ? 'selected' : '' }}>{{ ucwords($item->kode_kriteria .' | '. $item->nama_kriteria ) }}</option>
            @endforeach
          </select>
          @error('kode')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Nama Atribut</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('nama') is-invalid @enderror" autocomplete="off" id="nama" name="nama" type="text" required value="{{ $sub->nama_atribut }}">
          @error('nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Nilai Atribut</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('nilai') is-invalid @enderror" autocomplete="off" id="nilai" name="nilai" type="number" required value="{{ $sub->nilai_atribut }}">
          @error('nilai')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>


      <div class="separator separator-dashed my-4"></div>
      <div class="d-flex justify-content-end">
        <a href="{{ route('atribut.index') }}" click="resetForm" class="btn btn-light btn-lg me-2 w-100 mb-5">Kembali</a>
        <button type="submit" class="btn btn-lg btn-primary ms-2 w-100 mb-5">Save</button>
      </div>
    </form>

  </div>

</div>

@endsection
