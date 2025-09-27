<?php
namespace App\Http\Controllers;
class PosyanduController extends Controller {
    public function index() {
        $posyandu = [
            [
                'posyandu_id' => 1,
                'nama' => 'Posyandu Mawar',
                'alamat' => 'Jl. Melati No. 10',
                'rt' => '01',
                'rw' => '02',
                'kontak' => '081234567890'
            ],
            [
                'posyandu_id' => 2,
                'nama' => 'Posyandu Melati',
                'alamat' => 'Jl. Kenanga No. 5',
                'rt' => '03',
                'rw' => '04',
                'kontak' => '081298765432'
            ]
        ];
        return view('posyandu.index', compact('posyandu'));
    }
}