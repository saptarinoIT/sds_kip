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
        <li class="breadcrumb-item text-white opacity-75 small">Data Kriteria</li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header border-0 pt-6">
        <h3 class="card-title">Data Kriteria</h3>
        @if (auth()->user()->role == 'superadmin' or auth()->user()->role == 'manager')
        <div class="card-toolbar">
            <a href="{{ route('kriteria.create') }}"
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
                                <th class="fw-bold" style="align-items: center;">Kode Kriteria</th>
                                <th class="fw-bold">Nama Kriteria</th>
                                <th class="fw-bold">Nilai Kepentingan</th>
                                @if (auth()->user()->role == 'superadmin' or auth()->user()->role == 'manager')
                                <th class="fw-bold">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarKri as $p)
                            <tr>
                                <td>{{ ucwords($p->kode_kriteria) }}</td>
                                <td>{{ ucwords($p->nama_kriteria) }}</td>
                                <td>{{ $p->bobot * 100 }} %</td>
                                @if (auth()->user()->role == 'superadmin' or auth()->user()->role == 'manager')
                                <td class="d-flex">
                                    <a href="{{ route('kriteria.edit', $p->id) }}"
                                        class="btn btn-sm btn-outline btn-outline-warning btn-active-light-warning me-2"><small>Edit</small></a>
                                    <form action="{{ route('kriteria.destroy', $p->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline btn-outline-danger btn-active-light-danger me-2">Delete</button>
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