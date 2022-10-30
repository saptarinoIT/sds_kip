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
            <li class="breadcrumb-item text-white opacity-75 small">Tambah Data Alternatif</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h2 class="mb-1">Tambah Data Alternatif</h2>
            </div>
        </div>
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form action="{{ route('pendaftar.store') }}" class="contact-form" method="POST">
                @csrf
                <div class="form-section">
                    <div class="mb-3">
                        <label class="form-label">Petugas Survey</label>
                        <input type="text" class="form-control bg-light" readonly
                            value="{{ ucwords(auth()->user()->name) }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pendaftar <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            required>
                        @error('nama')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat (Tempat Tinggal Saat Ini) <span
                                class="text-danger">*</span></label>
                        <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"></textarea>
                        @error('alamat')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">RT <span class="text-danger">*</span></label>
                        <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror"
                            required>
                        @error('rt')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                        <select name="kelurahan" class="form-select">
                            @foreach ($kelurahan as $k)
                                <option value="{{ $k['nama'] }}">{{ ucwords($k['nama']) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Asal Sekolah <span class="text-danger">*</span></label>
                        <input type="text" name="asal_sekolah"
                            class="form-control @error('asal_sekolah') is-invalid @enderror" required>
                        @error('asal_sekolah')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenjang</label>
                        <select class="form-select" onchange="selectJenjang(this);" name="jenjang">
                            <option>Pilih salah satu ...</option>
                            <option value="sd">Sekolah Dasar</option>
                            <option value="smp">Sekolah Menengah Pertama</option>
                            <option value="sma">Sekolah Menengah Atas</option>
                        </select>
                    </div>
                    <div class="d-none" id="pilihSMA">
                        <div class="mb-3">
                            <label class="form-label">Pilihan Universitas <span class="text-danger">*</span></label>
                            <input type="text" name="universitas"
                                class="form-control @error('universitas') is-invalid @enderror">
                            @error('universitas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fakultas <span class="text-danger">*</span></label>
                            <input type="text" name="fakultas"
                                class="form-control @error('fakultas') is-invalid @enderror">
                            @error('fakultas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                            <input type="text" name="jurusan"
                                class="form-control @error('jurusan') is-invalid @enderror">
                            @error('jurusan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                        <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror"
                            required>
                        @error('nama_ayah')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                        <input type="text" name="nama_ibu"
                            class="form-control @error('nama_ibu') is-invalid @enderror" required>
                        @error('nama_ibu')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Wali</label>
                        <input type="text" name="nama_wali"
                            class="form-control @error('nama_wali') is-invalid @enderror">
                        @error('nama_wali')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <div class="mb-3">
                        <label class="form-label">Kondisi Orang Tua <span class="text-danger">*</span></label>
                        <select name="c1" class="form-select">
                            <option value="1">Tidak Punya</option>
                            <option value="2">Yatim/Piatu</option>
                            <option value="3">Orang Tua Lengkap</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan Ayah <span class="text-danger">*</span></label>
                        <input type="text" name="pek_ayah"
                            class="form-control @error('pek_ayah') is-invalid @enderror" required>
                        @error('pek_ayah')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan Ibu <span class="text-danger">*</span></label>
                        <input type="text" name="pek_ibu" class="form-control @error('pek_ibu') is-invalid @enderror"
                            required>
                        @error('pek_ibu')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan Wali</label>
                        <input type="text" name="pek_wali"
                            class="form-control @error('pek_wali') is-invalid @enderror">
                        @error('pek_wali')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penghasilan per Bulan (Ayah) <span class="text-danger">*</span></label>
                        <input type="number" name="peng_ayah"
                            class="form-control @error('peng_ayah') is-invalid @enderror" required>
                        @error('peng_ayah')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penghasilan per Bulan (Ibu) <span class="text-danger">*</span></label>
                        <input type="number" name="peng_ibu"
                            class="form-control @error('peng_ibu') is-invalid @enderror" required>
                        @error('peng_ibu')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penghasilan per Bulan (Wali)</label>
                        <input type="number" name="peng_wali"
                            class="form-control @error('peng_wali') is-invalid @enderror">
                        @error('peng_wali')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <div class="mb-3">
                        <label class="form-label">Rumah/Bagunan (*pilih salah satu) <span
                                class="text-danger">*</span></label>
                        <select name="c3" class="form-select">
                            <option value="1">Tidak Memiliki</option>
                            <option value="2">Memiliki</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        {{-- <label class="form-label">Tabungan (dalam bentuk uang) <span class="text-danger">*</span></label> --}}
                        {{-- <select name="c4" class="form-select">
                            <option value="4">Rp 0</option>
                            <option value="3">Rp 500.000 - Rp 5.000.000</option>
                            <option value="2">Rp 5.000.001 - Rp 10.000.000</option>
                            <option value=">1">> Rp 10.000.001</option>
                        </select> --}}
                        <label class="form-label">Kepemilikan Harta</label>
                        <input type="number" name="c4" class="form-control @error('c4') is-invalid @enderror">
                        @error('c4')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <div class="mb-3">
                        <label class="form-label">Kebutuhan Pangan <span class="text-danger">*</span></label>
                        <input type="number" name="pangan" class="form-control @error('pangan') is-invalid @enderror"
                            required>
                        @error('pangan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kebutuhan Sandang <span class="text-danger">*</span></label>
                        <input type="number" name="sandang" class="form-control @error('sandang') is-invalid @enderror"
                            required>
                        @error('sandang')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Air PDAM <span class="text-danger">*</span></label>
                        <input type="number" name="pdam" class="form-control @error('pdam') is-invalid @enderror">
                        @error('pdam')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Listrik/Penerangan <span class="text-danger">*</span></label>
                        <input type="number" name="listrik" class="form-control @error('listrik') is-invalid @enderror"
                            required>
                        @error('listrik')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tagihan Internet bulanan <span class="text-danger">*</span></label>
                        <input type="number" name="internet"
                            class="form-control @error('internet') is-invalid @enderror">
                        @error('internet')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon/Pulsa HP (dalam 1 rumah) <span
                                class="text-danger">*</span></label>
                        <input type="number" name="pulsa" class="form-control @error('pulsa') is-invalid @enderror"
                            required>
                        @error('pulsa')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Transportasi (bensin) <span class="text-danger">*</span></label>
                        <input type="number" name="transportasi"
                            class="form-control @error('transportasi') is-invalid @enderror" required>
                        @error('transportasi')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cicilan (tiap bulan) <span class="text-danger">*</span></label>
                        <input type="number" name="cicilan"
                            class="form-control @error('cicilan') is-invalid @enderror">
                        @error('cicilan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sewa Rumah/bln (*jika ada)</label>
                        <input type="number" name="sewa_rumah"
                            class="form-control @error('sewa_rumah') is-invalid @enderror">
                        @error('sewa_rumah')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hutang Bank/Sisa Pinjaman Bank <span
                                class="text-danger">*</span></label>
                        <select name="c6" class="form-select">
                            <option value="1">Rp 0</option>
                            <option value="2">Rp 1 - Rp 5.000.000</option>
                            <option value="3">Rp 5.000.001 - Rp 10.000.000</option>
                            <option value="4"> Rp 10.000.001 - Rp 50.000.000</option>
                            <option value="5">Lebih dari Rp 50.000.000</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hutang Lain/Sisa Hutang Lainnya (Hutang konsumtif) <span
                                class="text-danger">*</span></label>
                        <select name="c7" class="form-select">
                            <option value="5">Rp 0</option>
                            <option value="4">Rp 1 - Rp 500.000</option>
                            <option value="3">Rp 500.001 - Rp 2.000.000</option>
                            <option value="2"> Rp 2.000.001 - Rp 5.000.000</option>
                            <option value="1">Lebih dari Rp 5.000.000</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hasil Survey (Keterangan Kondisi Narasumber dan Rekomendasi
                        Surveyor) <span class="text-danger">*</span></label>
                    <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
                    @error('keterangan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn bg-gradient-dark">Kirim Survey</button>
            </form>

        </div>

    </div>
@endsection

@section('customjs')
    <script>
        function selectJenjang(value) {

        }
    </script>
@endsection
