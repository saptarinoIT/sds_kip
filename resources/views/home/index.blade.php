@extends('layout.app')

@section('panelhead')
<div class="page-title d-flex flex-column me-3">
  <h1 class="d-flex text-white fw-bolder my-1 fs-3">Dashboard</h1>
  <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-white opacity-75">
      <a href="." class="text-white text-hover-primary small">Home</a>
    </li>
  </ul>
</div>
@endsection


@section('content')

<div class="row">
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h5>Total Siswa SD</h5>
        <h1>{{ count($siswaSD) }}</h1>
        <h6 class="fw-light">Siswa</h6>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h5>Total Siswa SMP</h5>
        <h1>{{ count($siswaSMP) }}</h1>
        <h6 class="fw-light">Siswa</h6>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h5>Total Siswa SMA</h5>
        <h1>{{ count($siswaSMA) }}</h1>
        <h6 class="fw-light">Siswa</h6>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')

@endsection
