@extends('layout.app')


@section('panelhead')
<div class="page-title d-flex flex-column me-3">
    <h1 class="d-flex text-white fw-bolder my-1 fs-3">Nilai Atribut</h1>
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
        <li class="breadcrumb-item text-white opacity-75 small">Nilai Atribut</li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header border-0 pt-6">
        <h3 class="card-title">Nilai Atribut</h3>
        @if (auth()->user()->role == 'superadmin' or auth()->user()->role == 'manager')
        <div class="card-toolbar">
            <a href="{{ route('atribut.create') }}"
                class="btn btn-outline btn-outline-success btn-active-light-success ">Tambah</a>
        </div>
        @endif
    </div>

    <!--begin::Card body-->
    <div class="card-body py-4">

        @if ($message = Session::get('success'))
        <!--begin::Alert-->
        <div class="alert alert-success">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column">
                <!--begin::Title-->
                <h4 class="mb-1 text-dark">Berhasil</h4>
                <!--end::Title-->
                <!--begin::Content-->
                <span>{{ $message }}</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
        @endif

        {{-- 7771235312V451 --}}
        <div class="separator separator-dashed my-4"></div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

                <div class="table-responsive">

                    <table class="table table-row-bordered display nowrap" id="tblpenilaian" style="width:100%">
                        <thead>
                            <tr>
                                <th class="fw-bold">Kriteria</th>
                                <th class="fw-bold">Nama Kriteria</th>
                                <th class="fw-bold">Atribut</th>
                                <th class="fw-bold">Nilai Atribut</th>
                                @if (auth()->user()->role == 'superadmin' or auth()->user()->role == 'manager')
                                <th class="fw-bold">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($atribut as $p)
                            <tr>
                                <td>{{ ucwords($p->kriteria->kode_kriteria) }}</td>
                                <td>{{ ucwords($p->kriteria->nama_kriteria) }}</td>
                                <td>{{ ucwords($p->nama_atribut) }}</td>
                                <td>{{ ucwords($p->nilai_atribut) }}</td>
                                @if (auth()->user()->role == 'superadmin' or auth()->user()->role == 'manager')
                                <td class="d-flex">
                                    <a href="{{ route('atribut.edit', $p->id) }}"
                                        class="btn btn-sm btn-outline btn-outline-warning btn-active-light-warning me-2 hidex"><small>Edit</small></a>
                                    <form action="{{ route('atribut.destroy', $p->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline btn-outline-danger btn-active-light-danger hidex">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>


    </div>
    <!--end::Card body-->
</div>
@endsection