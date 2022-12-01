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
            <li class="breadcrumb-item text-white opacity-75 small">Detail Data Pendaftar</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h2 class="mb-1">Detail Data Pendaftar</h2>
            </div>
        </div>
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="table-responsive">
                <div class="py-5">
                    <table class="table table-row-dashed table-row-gray-300 gy-7">
                        {{-- <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Petugas Surveyor</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->user->name) }}</td>
                        </tr> --}}
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Kode Alternatif</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->kode_alternatif) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Nama</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->nama) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Alamat</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->alamat) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Jurusan</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->jurusan) }}</td>
                        </tr>
                        {{-- <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Asal Sekolah</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->asal_sekolah) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Nama Ayah</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->nama_ayah) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Nama Ibu</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->nama_ibu) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Nama Wali</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->nama_wali) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Pekerjaan Ayah</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->pek_ayah) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Pekerjaan Ibu</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->pek_ibu) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Pekerjaan Wali</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->pek_wali) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Penghasilan Ayah</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->peng_ayah, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Penghasilan Ibu</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->peng_ibu, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Penghasilan Wali</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->peng_wali, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Kebutuhan Pangan</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->pangan, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Kebutuhan Sandang</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->sandang, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Air PDAM</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->pdam, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Listrik/penerangan</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->listrik, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Tagihan Internet bulanan</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->internet, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Telepon/Pulsa HP (dalam 1 rumah)</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->pulsa, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Transportasi (bensin)</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->transportasi, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Cicilan (tiap bulan)</th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->cicilan, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Sewa Rumah/bln </th>
                            <th>:</th>
                            <td>Rp {{ number_format($pendaftar->sewa_rumah, 0) }}</td>
                        </tr> --}}
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Tahun</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->tahun) }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder fs-6 text-gray-800">Keterangan</th>
                            <th>:</th>
                            <td>{{ ucwords($pendaftar->keterangan) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
