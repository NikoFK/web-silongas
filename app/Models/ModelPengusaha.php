<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengusaha extends Model
{
    // Mendefinisikan method AllData untuk mengambil semua data pengusaha level 2
    public function AllData(){
        // Menggunakan Query Builder dari CodeIgniter untuk memilih tabel 'tbl_user'
        return $this->db->table('tbl_user')
            // Menambahkan kondisi WHERE untuk memfilter baris berdasarkan kolom 'level' yang nilainya 2
            ->where('level', 2)
            // Melakukan eksekusi query dengan method get() untuk mengambil hasilnya
            ->get()
            // Mengembalikan hasil query dalam bentuk array menggunakan getResultArray()
            ->getResultArray();
    }
}

