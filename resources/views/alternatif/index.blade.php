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
            <li class="breadcrumb-item text-white opacity-75 small">Data Alternatif</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h2 class="mb-1">Data Alternatif</h2>
            </div>

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

            {{-- @if (Omjin::permission('penilaianCreate')) --}}
            @if (auth()->user()->role == 'admin' or
                auth()->user()->role == 'superadmin' or
                auth()->user()->role == 'surveyor')
                <div class="d-flex justify-content-between">
                    <a href="{{ route('alternatif.create') }}" data-state="0" id="add"
                        class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex"><small>Add</small></a>
                @else
                    <div class="d-flex justify-content-end">
            @endif
            <form action="{{ route('alternatif.filter') }}" method="POST" class="d-flex">
                @csrf
                <select name="jurusan" id="jurusan" class="form-select form-select-solid s2x mx-2" required>
                    <option value="">Jurusan</option>
                    <option value="ti">Teknik Informatika</option>
                    <option value="te">Teknik Elektro</option>
                </select>
                <select name="tahun" id="tahun" class="form-select form-select-solid s2x mx-2" required>
                    <option value="">Tahun</option>
                    @php
                        for ($i = date('Y'); $i >= date('Y') - 1; $i -= 1) {
                            echo "<option value='$i'> $i </option>";
                        }
                    @endphp
                </select>
                <button type="submit"
                    class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex">Filter</button>
            </form>
            {{-- @endif --}}
        </div>
        {{-- 7771235312V451 --}}
        <div class="separator separator-dashed my-4"></div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

                <div class="table-responsive">

                    <table class="table table-row-bordered display nowrap" id="tblpenilaian" style="width:100%">
                        <thead>
                            @if (!$alternatif == [])
                                <tr style="border-bottom: 1.3px solid rgb(50, 50, 50) !important">
                                    <th class="fw-bolder">Kode Pendaftaran</th>
                                    <th class="fw-bolder">Jurusan</th>
                                    <th class="fw-bolder">Tahun</th>
                                    @if (auth()->user()->role == 'admin' or auth()->user()->role == 'surveyor')
                                        <th class="fw-bolder col-1">Aksi</th>
                                    @endif
                                </tr>
                            @endif
                        </thead>
                        <tbody>
                            @forelse ($alternatif as $p)
                                <tr>
                                    <td>{{ strtoupper($p->kode_alternatif) }}</td>
                                    <td>{{ strtoupper($p->jurusan) }}</td>
                                    <td>{{ $p->tahun }}</td>
                                    @if (auth()->user()->role == 'admin' or auth()->user()->role == 'surveyor')
                                        <td class="d-flex">
                                            <a href="{{ route('alternatif.show', $p->id) }}"
                                                class="btn btn-sm btn-light-warning mx-1">Detail</a>
                                            @if ($p->kriteria->isEmpty())
                                                <a href="{{ route('alternatif.edit', $p->id) }}"
                                                    class="btn btn-sm btn-light-warning">Input</a>
                                            @endif
                                            <form class="mx-1" action="{{ route('alternatif.destroy', $p->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-light-danger">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                @if (!$alternatif == [])
                                    <tr class="text-center">
                                        <td colspan="11" class="text-center">Data Tidak Tersedia</td>
                                    </tr>
                                @endif
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
        </div>


    </div>
    <!--end::Card body-->
    </div>


@endsection
