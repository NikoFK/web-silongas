<?php

namespace App\Controllers;

use App\Models\ModelProfilUsaha; // Mengimpor model profil usaha

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelProfilUsaha = new ModelProfilUsaha(); // Membuat instance dari model profil usaha
    }

    public function index()
    {
        // Menyiapkan data yang akan dikirim ke view
        $data = [
            'judul' => 'Home', // Menetapkan judul halaman
            'page' => 'v_home', // Menetapkan halaman yang akan ditampilkan
            'users' => $this->ModelProfilUsaha->AllData(), // Mengambil semua data profil usaha
        ];
        
        // Memuat tampilan template front end dengan data yang telah ditetapkan
        return view('v_template_front_end.php', $data);
    }
}
