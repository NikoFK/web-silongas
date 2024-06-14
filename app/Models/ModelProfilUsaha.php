<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProfilUsaha extends Model
{
    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'tbl_profil_usaha';

    // Menentukan primary key dari tabel
    protected $primaryKey = 'id_profil_usaha';

    // Daftar field yang diizinkan untuk diisi (allowed) ketika melakukan insert atau update
    protected $allowedFields = [
        'id_user', 'nama_usaha', 'deskripsi_usaha', 'foto_usaha', 'lokasi_usaha'
    ];

    // Method untuk mengambil semua data profil usaha pengusaha level 2
    public function AllData()
    {
        // Menghubungkan ke database
        $db = \Config\Database::connect();

        // Query SQL untuk mengambil data yang diinginkan
        $query = "
            SELECT 
                u.username, 
                u.nama, 
                u.ttl, 
                u.foto, 
                u.level, 
                u.no_hp, 
                p.nama_usaha, 
                p.deskripsi_usaha, 
                p.lokasi_usaha, 
                p.foto_usaha
            FROM 
                tbl_user u
            LEFT JOIN 
                tbl_profil_usaha p ON u.id_user = p.id_user
            WHERE 
                u.level = 2
                AND p.deskripsi_usaha <> ''
        ";

        // Menjalankan query dan mengembalikan hasilnya dalam bentuk array
        return $db->query($query)->getResultArray();
    }

    // Method untuk menghitung jumlah atribut kosong dalam profil usaha
    public function hitungAtributKosongProfilUsaha()
    {
        // Mendapatkan username dari session
        $username = session()->get('username');

        // Jika tidak ada session username, maka kembalikan 0
        if (!$username) {
            return 0;
        }

        // Menghubungkan ke database
        $db = \Config\Database::connect();

        // Query SQL untuk menghitung jumlah atribut kosong
        $query = "
            SELECT 
                SUM(
                    (nama_usaha IS NULL OR nama_usaha = '') +
                    (deskripsi_usaha IS NULL OR deskripsi_usaha = '') +
                    (foto_usaha IS NULL OR foto_usaha = '') +
                    (lokasi_usaha IS NULL OR lokasi_usaha = '') +
                    (nomor_rekening IS NULL OR nomor_rekening = '')
                ) AS total_empty
            FROM tbl_profil_usaha pu
            JOIN tbl_user u ON u.id_user = pu.id_user
            WHERE u.username = ?
        ";

        // Menjalankan query dengan memberikan parameter username dari session
        $result = $db->query($query, [$username])->getRow();

        // Mengembalikan hasil jumlah atribut kosong
        return $result->total_empty;
    }

    // Method untuk melakukan update data dalam tabel berdasarkan id_user
    public function updateData($id_user, $data)
    {
        return $this->db->table('tbl_profil_usaha')
            ->where('id_user', $id_user)
            ->update($data);
    }

    // Method untuk mendapatkan id_user berdasarkan username
    public function getIdUserByUsername($username)
    {
        // Mengambil id_user dari tabel tbl_user berdasarkan username
        $result = $this->db->table('tbl_user')
            ->select('id_user')
            ->where('username', $username)
            ->get()
            ->getRow();

        // Mengembalikan id_user jika ditemukan, atau null jika tidak ditemukan
        return $result ? $result->id_user : null;
    }
}
