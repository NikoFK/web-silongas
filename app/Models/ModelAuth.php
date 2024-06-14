<?php

namespace App\Models;

use CodeIgniter\Model; // Mengimpor kelas Model dari CodeIgniter

class ModelAuth extends Model
{
    // Method untuk melakukan login user berdasarkan username dan level
    public function LoginUser($username, $level){
        return $this->db->table('tbl_user')
            ->where([
                'username' => $username,
                'level' => $level,
            ])->get()->getRowArray();
    }
    
    // Method untuk mendapatkan profil usaha berdasarkan id_user
    public function getProfilUsahaByIdUser($id_user) {
        return $this->db->table('tbl_profil_usaha')
            ->where('id_user', $id_user)
            ->get()->getRowArray();
    }
    
    // Method untuk menyisipkan (insert) data profil usaha default
    public function insertProfilUsaha($id_user)
    {
        $this->db->table('tbl_profil_usaha')->insert([
            'id_user' => $id_user,
            'nama_usaha' => '',
            'deskripsi_usaha' => '',
            'foto_usaha' => 'default-foto-profil-usaha.jpg',
            'lokasi_usaha' => ''
        ]);
    }
}
