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
        <div class="col-md-6 col-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <h5>Teknik Informatika</h5>
                    <h1>{{ count($ti) }}</h1>
                    <h6 class="fw-light">Mahasiswa</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <h5>Teknik Elektro</h5>
                    <h1>{{ count($te) }}</h1>
                    <h6 class="fw-light">Mahasiswa</h6>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
@endsection
