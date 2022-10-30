<div class="menu-item me-lg-1">
    <a href="{{ route('app.index') }}" class="menu-link py-3">
        <span class="menu-title">Dashboard</span>
    </a>
</div>

{{-- @if (Auth::user()->role == 'surveyor')
<div class="menu-item me-lg-1">
    <a href="{{ route('kriteria.index') }}" class="menu-link py-3">
        <span class="menu-title">Data Kriteria</span>
    </a>
</div>

<div class="menu-item me-lg-1">
    <a href="{{ route('alternatif.index') }}" class="menu-link py-3">
        <span class="menu-title">Data Alternatif</span>
    </a>
</div>
@endif --}}

@if (Auth::user()->role == 'superadmin' or Auth::user()->role == 'admin' or Auth::user()->role == 'manager' or
Auth::user()->role == 'surveyor')
<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
    class="menu-item menu-lg-down-accordion me-lg-1">
    <span class="menu-link py-3">
        <span class="menu-title">Kriteria</span>
        <span class="menu-arrow d-lg-none"></span>
    </span>
    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px" style="">
        <div class="menu-item">
            <a class="menu-link py-3" href="{{ route('kriteria.index') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Data Kriteria</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link py-3" href="{{ route('atribut.index') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Nilai Atribut</span>
            </a>
        </div>
    </div>
</div>

<div class="menu-item me-lg-1">
    <a href="{{ route('pendaftar.index') }}" class="menu-link py-3">
        <span class="menu-title">Pendaftaran</span>
    </a>
</div>

{{-- <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
    class="menu-item menu-lg-down-accordion me-lg-1">
    <span class="menu-link py-3">
        <span class="menu-title">Alternatif</span>
        <span class="menu-arrow d-lg-none"></span>
    </span>
    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px" style="">
        <div class="menu-item">
            <a class="menu-link py-3" href="{{ route('alternatif.index') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Data Alternatif</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link py-3" href="{{ route('nilai-alternatif.index') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Nilai Alternatif</span>
            </a>
        </div>
    </div>
</div> --}}
@endif

@if (Auth::user()->role == 'superadmin' or Auth::user()->role == 'admin' or Auth::user()->role == 'manager')
<div class="menu-item me-lg-1">
    <a href="{{ route('perhitungan.index') }}" class="menu-link py-3">
        <span class="menu-title">Perhitungan</span>
    </a>
</div>
@endif

@if (Auth::user()->role == 'superadmin' or Auth::user()->role == 'admin')
<div class="menu-item me-lg-1">
    <a href="{{ route('user.index') }}" class="menu-link py-3">
        <span class="menu-title">Data User Login</span>
    </a>
</div>
@endif

<div class="menu-item mx-3">
    <a href="{{ route('logout') }}" class="btn btn-danger menu-link py-3">
        <span class="menu-title text-white">Logout</span>
    </a>
</div>