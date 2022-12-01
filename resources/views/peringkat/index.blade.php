@extends('layout.app')

@section('panelhead')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="d-flex text-white fw-bolder my-1 fs-3">Perhitungan</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-white opacity-75">
                <a href="." class="text-white text-hover-primary small">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-white opacity-75 small">Perhitungan</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="d-none print-title justify-content-center pt-5">
            <h3>Hasil Data Beasiswa Pupuk Kalimantan Timur</h3>
        </div>
        <div class="card-header header-perhitungan border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h2 class="mb-1">Perhitungan</h2>
            </div>


            <form action="{{ route('perhitungan.filter') }}" method="post" class="d-flex filter">
                @csrf
                <select name="jurusan" id="jurusan" class="form-select form-select-solid s2x mx-2" required>
                    <option>Pilih salah satu ...</option>
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
            <div class="card-title flex-column">
                <h4 class="mb-1">Konversi Nilai </h4>
            </div>

            <div class="d-flex">
                {{-- @if (Omjin::permission('penilaianCreate')) --}}
                {{-- <a href="{{ route('normalisasi.index') }}" data-state="0" id="add"
                class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex"><small>Save
                    Data</small></a> --}}
                {{-- @endif --}}
            </div>
            {{-- 7771235312V451 --}}
            <div class="separator separator-dashed my-4"></div>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

                    <div class="table-responsive">

                        <table class="table table-striped no-wrap" id="tblpenilaian" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center fw-bolder">Nama</th>
                                    @foreach ($kriteria as $krit)
                                        <th class="text-center fw-bolder">{{ ucwords($krit->nama_kriteria) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($alternatif))
                                    @foreach ($alternatif as $data)
                                        <tr>
                                            <td>{{ $data->kode_alternatif }}</td>
                                            @foreach ($data->nilai as $crip)
                                                <td>{{ $crip->nilai }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="{{ count($kriteria) + 1 }}" class="text-center">Data tidak ditemukan
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>


        </div>
        <!--end::Card body-->
    </div>

    <div class="card mt-4">
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h4 class="mb-1">Normalisasi Data </h4>
            </div>
        </div>

        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="table-responsive">
                <table class="table table-striped no-wrap">
                    <thead>
                        <tr>
                            <th class="fw-bolder">Kode</th>
                            <?php $bobot = []; ?>
                            @foreach ($kriteria as $krit)
                                <?php $bobot[$krit->id] = $krit->bobot; ?>
                                <th class="fw-bolder">{{ $krit->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($alternatif))
                            <?php $rangking = []; ?>
                            @foreach ($alternatif as $data)
                                <tr>
                                    <td>{{ $data->kode_alternatif }}</td>
                                    <?php $total = 0; ?>
                                    @foreach ($data->nilai as $crip)
                                        <?php $normalisasi = $kode_krit[$crip->kriteria->id] / $crip->nilai; ?>
                                        <?php $total = $total + $bobot[$crip->kriteria->id] * $normalisasi; ?>
                                        <td>{{ $normalisasi }}</td>
                                    @endforeach
                                    <?php $rangking[] = [
                                        'total' => $total,
                                        'kode' => $data->kode_alternatif,
                                        'jurusan' => $data->jurusan,
                                        'tahun' => $data->tahun,
                                    ]; ?>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ count($kriteria) + 1 }}" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Card body-->
    </div>

    <div class="col-md-12 card-deck mt-4">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title flex-column">
                    <h4 class="mb-1">Perankingan</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped no-wrap">
                        <thead>
                            <tr>
                                <th class="fw-bolder">Kode</th>
                                <th class="fw-bolder">Jurusan</th>
                                <th class="fw-bolder">Tahun</th>
                                <th class="fw-bolder">Total</th>
                                <th class="fw-bolder">Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($alternatif))
                                <?php
                                usort($rangking, function ($a, $b) {
                                    return $a['total'] <=> $b['total'];
                                });
                                rsort($rangking);
                                $a = 1;
                                ?>
                                @foreach ($rangking as $t)
                                    <tr>
                                        <td>{{ strtoupper($t['kode']) }}</td>
                                        <td>{{ strtoupper($t['jurusan']) }}</td>
                                        <td>{{ $t['tahun'] }}</td>
                                        <td>{{ $t['total'] }}</td>
                                        <td>{{ $a++ }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="{{ count($kriteria) + 1 }}" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (auth()->user()->role == 'manager')
                <div class="d-flex justify-content-end p-5 cetak">
                    <button onclick="{window.print()}" class="btn btn-primary">Cetak Laporan</button>
                </div>
            @endif
        </div>

    </div>




@endsection
