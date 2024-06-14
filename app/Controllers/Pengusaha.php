<?php

namespace App\Controllers;

use App\Models\ModelAkun; // Mengimpor model akun
use App\Models\ModelPengusaha; // Mengimpor model pengusaha
use App\Models\ModelProfilUsaha; // Mengimpor model profil usaha

class Pengusaha extends BaseController
{
    public function __construct()
    {
        // Membuat instance dari masing-masing model dan menyimpannya dalam properti kelas
        $this->ModelAkun = new ModelAkun();
        $this->ModelProfilUsaha = new ModelProfilUsaha();
        $this->ModelPengusaha = new ModelPengusaha();
    }

    public function index()
    {
        $data = [
            'judul' => 'Pengusaha', // Menetapkan judul halaman
            'menu' => 'pengusaha', // Menetapkan menu yang aktif
            'page' => 'v_pengusaha', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' => $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' => $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'pengusaha' => $this->ModelPengusaha->AllData(), // Mengambil semua data pengusaha
        ];
        // Memuat tampilan template back end dengan data yang telah ditetapkan
        return view('v_template_back_end.php', $data);
    }
}
