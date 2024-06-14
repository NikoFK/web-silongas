<?php

namespace App\Models;

use CodeIgniter\Model; // Mengimpor kelas Model dari CodeIgniter

class ModelAkun extends Model
{
    protected $table = 'tbl_user'; // Menetapkan nama tabel database yang akan digunakan
    protected $primaryKey = 'id_user'; // Menetapkan primary key dari tabel

    // Daftar field yang diizinkan untuk diisi (allowedFields)
    protected $allowedFields = [
        'nama', 'level', 'username', 'email', 'password', 'foto', 'ttl', 'jenis_kelamin', 'no_hp', 'alamat', 'tentang_aku'
    ];

    // Method untuk menghitung jumlah atribut kosong berdasarkan session username
    public function hitungAtributKosong()
    {
        // Mendapatkan username dari session
        $username = session()->get('username');

        // Jika tidak ada session username, maka kembalikan 0
        if (!$username) {
            return 0;
        }

        // Menggunakan \Config\Database untuk mengakses database
        $db = \Config\Database::connect();

        // Query untuk menghitung jumlah kolom kosong dalam tabel berdasarkan session username
        $query = "
            SELECT 
                SUM(
                    IFNULL(IF(nama IS NULL OR nama = '', 1, 0), 0) + 
                    IFNULL(IF(level IS NULL OR level = '', 1, 0), 0) + 
                    IFNULL(IF(username IS NULL OR username = '', 1, 0), 0) + 
                    IFNULL(IF(email IS NULL OR email = '', 1, 0), 0) + 
                    IFNULL(IF(password IS NULL OR password = '', 1, 0), 0) + 
                    IFNULL(IF(foto IS NULL OR foto = '', 1, 0), 0) + 
                    IFNULL(IF(ttl IS NULL OR ttl = '', 1, 0), 0) + 
                    IFNULL(IF(jenis_kelamin IS NULL OR jenis_kelamin = '', 1, 0), 0) + 
                    IFNULL(IF(no_hp IS NULL OR no_hp = '', 1, 0), 0) + 
                    IFNULL(IF(alamat IS NULL OR alamat = '', 1, 0), 0) + 
                    IFNULL(IF(tentang_aku IS NULL OR tentang_aku = '', 1, 0), 0)
                ) AS total_empty
            FROM tbl_user
            WHERE username = ?
        ";

        // Menjalankan query dengan memberikan parameter username dari session
        $result = $db->query($query, [$username])->getRow();

        // Mengembalikan hasil jumlah kolom kosong
        return $result->total_empty;
    }

    // Method untuk memperbarui data berdasarkan username
    public function updateData($username, $data)
    {
        return $this->db->table('tbl_user')
            ->where('username', $username)
            ->update($data);
    }

    // Method untuk menyisipkan (insert) data baru ke dalam tabel
    public function InsertData($data)
    {
        $this->db->table('tbl_user')->insert($data);
    }

    // Method untuk mendapatkan profil usaha berdasarkan id_user
    public function getProfilUsahaByUserId($id_user)
    {
        return $this->db->table('tbl_profil_usaha')
            ->where('id_user', $id_user)
            ->get()->getRowArray();
    }

    // Method untuk menghitung jumlah pengusaha dengan level 2
    public function hitungPengusahaLevel2()
    {
        return $this->db->table($this->table)
                        ->where('level', 2)
                        ->countAllResults();
    }

    // Method untuk menghapus data berdasarkan id_user
    public function DeleteData($data)
    {
        $deleted = $this->db->table('tbl_user')
            ->where('id_user', $data['id_user'])
            ->delete();

        return $deleted; // Mengembalikan status penghapusan data
    }
}
