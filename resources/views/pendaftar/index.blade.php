@extends('layout.app')


@section('panelhead')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="d-flex text-white fw-bolder my-1 fs-3">Data Pendaftar</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-white opacity-75">
                <a href="." class="text-white text-hover-primary small">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-white opacity-75 small">Pendaftar</li>
            <li class="breadcrumb-item">
                <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-white opacity-75 small">Data Pendaftar</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title flex-column">
                <h2 class="mb-1">Data Pendaftar</h2>
            </div>

        </div>

        <div class="card-body py-4">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-dark">Berhasil</h4>
                        <span>{{ $message }}</span>
                    </div>
                </div>
            @endif

            @if (auth()->user()->role == 'admin' or
                auth()->user()->role == 'superadmin' or
                auth()->user()->role == 'surveyor')
                <div class="d-flex justify-content-between">
                    <a href="{{ route('pendaftar.create') }}" data-state="0" id="add"
                        class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex"><small>Tambah
                            Data</small></a>
                @else
                    <div class="d-flex justify-content-end">
            @endif
            <form action="{{ route('pendaftar.filter') }}" method="POST" class="d-flex">
                @csrf
                <select name="jurusan" id="jurusan" class="form-select form-select-solid s2x mx-2">
                    <option>Pilih salah satu ...</option>
                    <option value="ti">Teknik Informatika</option>
                    <option value="te">Teknik Elektro</option>
                </select>
                <select name="tahun" id="tahun" class="form-select form-select-solid s2x mx-2">
                    <option value="">Tahun</option>
                    @php
                        for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
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
                        <thead class="text-center">
                            @if (!$alternatif == [])
                                <tr style="border-bottom: 1.3px solid rgb(50, 50, 50) !important">
                                    <th class="fw-bolder">Kode Pendaftaran</th>
                                    {{-- <th class="fw-bolder">Nama</th> --}}
                                    @foreach ($kriteria as $krit)
                                        <th class="text-center fw-bolder">{{ ucwords($krit->nama_kriteria) }}</th>
                                    @endforeach
                                    @if (auth()->user()->role == 'admin' or
                                        auth()->user()->role == 'surveyor' or
                                        auth()->user()->role == 'manager' or
                                        auth()->user()->role == 'superadmin')
                                        <th class="fw-bolder col-1">Aksi</th>
                                    @endif
                                </tr>
                            @endif
                        </thead>
                        <tbody class="text-center">
                            @forelse ($alternatif as $p)
                                <tr>
                                    <td>{{ strtoupper($p->kode_alternatif) }}</td>
                                    {{-- <td>{{ ucwords($p->nama) }}</td> --}}
                                    @foreach ($p->nilai as $nilai)
                                        <td>
                                            @if ($nilai->nilai < '10')
                                                @foreach ($nilai->kriteria->atribut as $item)
                                                    @if ($item->nilai_atribut == $nilai->nilai)
                                                        {{ ucwords($item->nama_atribut) }}
                                                    @endif
                                                @endforeach
                                            @else
                                                Rp {{ number_format($nilai->nilai, 0) }}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="d-flex">
                                        @if (auth()->user()->role == 'manager' or
                                            auth()->user()->role == 'admin' or
                                            auth()->user()->role == 'surveyor' or
                                            auth()->user()->role == 'superadmin')
                                            <a href="{{ route('pendaftar.show', $p->id) }}"
                                                class="btn btn-sm btn-light-info mx-1">Detail</a>
                                        @endif
                                        @if (auth()->user()->role == 'admin' or
                                            auth()->user()->role == 'surveyor' or
                                            auth()->user()->role == 'superadmin')
                                            <a href="{{ route('pendaftar.edit', $p->id) }}"
                                                class="btn btn-sm btn-light-warning">Ubah</a>
                                            <form class="mx-1" action="{{ route('pendaftar.destroy', $p->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-light-danger">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
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
