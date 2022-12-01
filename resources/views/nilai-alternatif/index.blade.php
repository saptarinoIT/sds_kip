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
                <h4 class="mb-1">Data Normalisasi Nilai</h4>
            </div>

            <form action="{{ route('nilai-alternatif.filter') }}" method="post" class="d-flex">
                @csrf
                <select name="jurusan" id="jurusan" class="form-select form-select-solid s2x mx-2" required>
                    <option value="">Pilih Jurusan ...</option>
                    <option value="ti">Teknik Informatika</option>
                    <option value="te">Teknik Elektro</option>
                </select>
                <select name="tahun" id="tahun" class="form-select form-select-solid s2x mx-2" required>
                    <option value="">Pilih Tahun ...</option>
                    @php
                        for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                            echo "<option value='$i'> $i </option>";
                        }
                    @endphp
                </select>
                <button type="submit"
                    class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex">Filter</button>
            </form>
        </div>

        <!--begin::Card body-->
        <div class="card-body py-4">

            <div class="d-flex">
                {{-- @if (Omjin::permission('penilaianCreate')) --}}
                {{-- <a href="{{ route('normalisasi.index') }}" data-state="0" id="add" class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex"><small>Save Data</small></a> --}}
                {{-- @endif --}}
            </div>
            {{-- 7771235312V451 --}}
            <div class="separator separator-dashed my-4"></div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

                    <div class="table-responsive">
                        <table class="table table-row-bordered display nowrap" id="tblpenilaian" style="width:100%">
                            <thead>
                                {{-- @if ($alternatif = []) --}}
                                <tr style="border-bottom: 1.3px solid rgb(50, 50, 50) !important">
                                    <th class="fw-bolder">Alternatif</th>
                                    @foreach ($kriteria as $k)
                                        <th class="fw-bolder">{{ ucwords($k->nama_kriteria) }}</th>
                                    @endforeach
                                    <th class="fw-bolder">Aksi</th>
                                </tr>
                                {{-- @endif --}}
                            </thead>
                            <tbody>
                                @if (!empty($alternatif))
                                    @foreach ($alternatif as $data)
                                        <tr>
                                            <td>{{ $data->kode_alternatif }}</td>
                                            @foreach ($data->nilai as $atribut)
                                                <td>{{ number_format($atribut->nilai, 0, ',', '.') }}</td>
                                            @endforeach
                                            @if (!$data->nilai->isEmpty())
                                                <td class="text-center">
                                                    <a href="{{ route('nilai-alternatif.edit', $data->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    {{-- @else
              <tr>
                <td colspan="{{(count($kriteria)+1)}}" class="text-center">Data tidak ditemukan</td>
              </tr> --}}
                                @endif
                            </tbody>
                        </table>

                    </div>


                </div>

            </div>


        </div>
        <!--end::Card body-->
    </div>


@endsection
