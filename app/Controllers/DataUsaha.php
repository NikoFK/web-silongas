<?php

namespace App\Controllers;

use App\Models\ModelAkun; // Mengimpor model akun
use App\Models\ModelProfilUsaha; // Mengimpor model profil usaha

class DataUsaha extends BaseController
{
    public function __construct()
    {
        $this->ModelAkun = new ModelAkun(); // Membuat instance dari model akun
        $this->ModelProfilUsaha = new ModelProfilUsaha(); // Membuat instance dari model profil usaha
    }

    public function index()
    {
        // Menyiapkan data yang akan dikirim ke view
        $data = [
            'judul' => 'Data Usaha', // Menetapkan judul halaman
            'menu' => 'data_usaha', // Menetapkan menu aktif menjadi data usaha
            'page' => 'v_data_usaha', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' =>  $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' =>  $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'users' => $this->ModelProfilUsaha->AllData() // Mengambil semua data profil usaha
        ];

        // Memuat tampilan template back end dengan data yang telah ditetapkan
        return view('v_template_back_end.php', $data);
    }
}
