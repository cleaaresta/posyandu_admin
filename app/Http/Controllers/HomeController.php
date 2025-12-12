<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaderPosyandu;
use App\Models\JadwalPosyandu;
use App\Models\CatatanImunisasi;
use App\Models\LayananPosyandu;
use App\Models\Posyandu;
use App\Models\User;
use App\Models\Warga;

class HomeController extends Controller
{
    public function index(){
        

        $total_imunisasi = CatatanImunisasi::count();
        $total_jadwal    = JadwalPosyandu::count();
        $total_kader     = KaderPosyandu::count();
        $total_layanan   = LayananPosyandu::count();
        $total_posyandu  = Posyandu::count();
        $total_user      = User::count();
        $total_warga     = Warga::count();

        return view('layouts.dashboard', compact(
            'total_imunisasi', 
            'total_jadwal', 
            'total_kader',
            'total_layanan',
            'total_posyandu',
            'total_user',
            'total_warga'
        ));

    }

}
