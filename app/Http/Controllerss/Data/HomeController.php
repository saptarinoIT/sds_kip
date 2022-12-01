<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\SiswaModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $siswaSD = Alternatif::where('jurusan', 'sd')->get();
        $siswaSMP = Alternatif::where('jurusan', 'smp')->get();
        $siswaSMA = Alternatif::where('jurusan', 'sma')->get();

        return view('home.index', compact('siswaSD', 'siswaSMP', 'siswaSMA'));
    }
}
