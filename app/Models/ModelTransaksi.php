<?php

namespace App\Models;  // Menentukan namespace dari model ini berada di dalam namespace App\Models

use CodeIgniter\Model;  // Mengimpor atau menggunakan kelas Model dari CodeIgniter

class ModelTransaksi extends Model
{
    protected $table = 'tbl_transaksi';  // Menentukan nama tabel yang digunakan oleh model
    protected $primaryKey = 'id_transaksi';  // Menentukan kolom primary key dari tabel
    protected $allowedFields = [  // Menentukan daftar field yang diizinkan untuk diisi (allowed fields) ketika melakukan insert atau update
        'id_user', 'invoice', 'status', 'bukti_pembayaran', 'total_harga', 'tanggal'
    ];

    // Method untuk menyisipkan (insert) data transaksi
    public function insertTransaksi($data)
    {
        $this->insert($data);  // Menyisipkan data ke dalam tabel
        return $this->getInsertID();  // Mengembalikan ID dari data yang baru saja disisipkan
    }

    // Method untuk memperbarui status transaksi menjadi 'diterima'
    public function UpdateStatusDiterima($id_transaksi, $status) {
        return $this->update($id_transaksi, ['status' => $status]);  // Memperbarui status transaksi berdasarkan id_transaksi
    }

    // Method untuk menghitung jumlah transaksi yang sedang diproses
    public function hitungTransaksiProses($id_user = null)
    {
        $builder = $this->db->table($this->table)
                            ->where('status', 'proses');  // Membuat query builder untuk menghitung transaksi dengan status 'proses'

        if ($id_user !== null) {
            $builder->where('id_user', $id_user);  // Menambahkan kondisi tambahan jika id_user tidak null
        }

        return $builder->countAllResults();  // Mengembalikan jumlah hasil query
    }

    // Method untuk menghitung jumlah transaksi yang diterima
    public function hitungTransaksiDiterima($id_user = null)
    {
        $builder = $this->db->table($this->table)
                            ->where('status', 'diterima');  // Membuat query builder untuk menghitung transaksi dengan status 'diterima'

        if ($id_user !== null) {
            $builder->where('id_user', $id_user);  // Menambahkan kondisi tambahan jika id_user tidak null
        }

        return $builder->countAllResults();  // Mengembalikan jumlah hasil query
    }

    // Method untuk menghitung jumlah transaksi yang selesai
    public function hitungTransaksiSelesai($id_user = null)
    {
        $builder = $this->db->table($this->table)
                            ->where('status', 'selesai');  // Membuat query builder untuk menghitung transaksi dengan status 'selesai'

        if ($id_user !== null) {
            $builder->where('id_user', $id_user);  // Menambahkan kondisi tambahan jika id_user tidak null
        }

        return $builder->countAllResults();  // Mengembalikan jumlah hasil query
    }

    // Method untuk mendapatkan total harga transaksi yang selesai pada hari ini
    public function getTotalHargaHariIni($id_user = null)
    {
        $builder = $this->db->table($this->table)
                            ->selectSum('total_harga')  // Menghitung total harga
                            ->where('DATE(tanggal)', date('Y-m-d'))  // Kondisi berdasarkan tanggal hari ini
                            ->where('status', 'selesai');  // Kondisi berdasarkan status 'selesai'

        if ($id_user !== null) {
            $builder->where('id_user', $id_user);  // Menambahkan kondisi tambahan jika id_user tidak null
        }

        $query = $builder->get();  // Menjalankan query
        return $query->getRow()->total_harga;  // Mengembalikan total harga dari hasil query
    }

    // Method untuk mendapatkan total harga transaksi yang selesai pada bulan ini
    public function getTotalHargaBulanIni($id_user = null)
    {
        $builder = $this->db->table($this->table)
                            ->selectSum('total_harga')  // Menghitung total harga
                            ->where('MONTH(tanggal)', date('m'))  // Kondisi berdasarkan bulan ini
                            ->where('YEAR(tanggal)', date('Y'))  // Kondisi berdasarkan tahun ini
                            ->where('status', 'selesai');  // Kondisi berdasarkan status 'selesai'

        if ($id_user !== null) {
            $builder->where('id_user', $id_user);  // Menambahkan kondisi tambahan jika id_user tidak null
        }

        $query = $builder->get();  // Menjalankan query
        return $query->getRow()->total_harga;  // Mengembalikan total harga dari hasil query
    }

    // Method untuk mendapatkan total harga transaksi yang selesai pada tahun ini
    public function getTotalHargaTahunIni($id_user = null)
    {
        $builder = $this->db->table($this->table)
                            ->selectSum('total_harga')  // Menghitung total harga
                            ->where('YEAR(tanggal)', date('Y'))  // Kondisi berdasarkan tahun ini
                            ->where('status', 'selesai');  // Kondisi berdasarkan status 'selesai'

        if ($id_user !== null) {
            $builder->where('id_user', $id_user);  // Menambahkan kondisi tambahan jika id_user tidak null
        }

        $query = $builder->get();  // Menjalankan query
        return $query->getRow()->total_harga;  // Mengembalikan total harga dari hasil query
    }

    // Method untuk mendapatkan total harga transaksi keseluruhan yang selesai
    public function getTotalHargaKeseluruhan($id_user = null)
    {
        $builder = $this->db->table($this->table)
                            ->selectSum('total_harga')  // Menghitung total harga
                            ->where('status', 'selesai');  // Kondisi berdasarkan status 'selesai'

        if ($id_user !== null) {
            $builder->where('id_user', $id_user);  // Menambahkan kondisi tambahan jika id_user tidak null
        }

        $query = $builder->get();  // Menjalankan query
        return $query->getRow()->total_harga;  // Mengembalikan total harga dari hasil query
    }

    // Method untuk mendapatkan total harga transaksi berdasarkan grup pengusaha
    public function getTotalHargaGrupPengusaha($id_user = null)
    {
        $builder = $this->db->table('tbl_transaksi t')
                            ->select('u.id_user, u.nama, u.foto, u.level, SUM(t.total_harga) as total_harga')  // Menghitung total harga dan mengambil data pengusaha
                            ->join('tbl_user u', 't.id_user = u.id_user')  // Melakukan join dengan tabel tbl_user
                            ->where('t.status', 'Selesai')  // Kondisi berdasarkan status 'selesai'
                            ->groupBy('u.id_user, u.nama, u.foto, u.level');  // Mengelompokkan hasil berdasarkan pengusaha

        if ($id_user !== null) {
            $builder->where('t.id_user', $id_user);  // Menambahkan kondisi tambahan jika id_user tidak null
        }

        return $builder->get()->getResultArray();  // Mengembalikan hasil query dalam bentuk array
    }

    // Method untuk mendapatkan transaksi dengan detail yang sedang diproses berdasarkan id_user
    public function getTransaksiWithDetailProses($id_user) {
        return $this->select('tbl_transaksi.*, tbl_user.nama, tbl_profil_usaha.nomor_rekening, tbl_profil_usaha.bank')
                    ->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id_user')  // Melakukan join dengan tabel tbl_user
                    ->join('tbl_profil_usaha', 'tbl_transaksi.id_user = tbl_profil_usaha.id_user')  // Melakukan join dengan tabel tbl_profil_usaha
                    ->where('tbl_transaksi.status', 'Proses')  // Kondisi berdasarkan status 'Proses'
                    ->where('tbl_transaksi.id_user', $id_user)  // Kondisi berdasarkan id_user
                    ->findAll();  // Mengembalikan semua hasil query
    }

    // Method untuk mendapatkan konfirmasi transaksi dengan detail yang sedang diproses
    public function getKonfirmasiTransaksiWithDetailProses() {
        return $this->select('tbl_transaksi.*, tbl_user.nama, tbl_profil_usaha.nomor_rekening, tbl_profil_usaha.bank')
                    ->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id_user')  // Melakukan join dengan tabel tbl_user
                    ->join('tbl_profil_usaha', 'tbl_transaksi.id_user = tbl_profil_usaha.id_user')  // Melakukan join dengan tabel tbl_profil_usaha
                    ->where('tbl_transaksi.status', 'Proses')  // Kondisi berdasarkan status 'Proses'
                    ->findAll();  // Mengembalikan semua hasil query
    }

    public function getTransaksiWithDetailDiterima($id_user) {
        return $this->select('tbl_transaksi.*, tbl_user.nama, tbl_profil_usaha.nomor_rekening, tbl_profil_usaha.bank')
                    ->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id_user')  // Melakukan join dengan tabel tbl_user
                    ->join('tbl_profil_usaha', 'tbl_transaksi.id_user = tbl_profil_usaha.id_user')  // Melakukan join dengan tabel tbl_profil_usaha
                    ->where('tbl_transaksi.status', 'Diterima')  // Kondisi berdasarkan status 'Diterima'
                    ->where('tbl_transaksi.id_user', $id_user)  // Kondisi berdasarkan id_user
                    ->findAll();  // Mengembalikan semua hasil query
    }
    
    // Method untuk mendapatkan konfirmasi transaksi dengan detail yang diterima
    public function getKonfirmasiTransaksiWithDetailDiterima() {
        return $this->select('tbl_transaksi.*, tbl_user.nama, tbl_profil_usaha.nomor_rekening, tbl_profil_usaha.bank')
                    ->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id_user')  // Melakukan join dengan tabel tbl_user
                    ->join('tbl_profil_usaha', 'tbl_transaksi.id_user = tbl_profil_usaha.id_user')  // Melakukan join dengan tabel tbl_profil_usaha
                    ->where('tbl_transaksi.status', 'Diterima')  // Kondisi berdasarkan status 'Diterima'
                    ->findAll();  // Mengembalikan semua hasil query
    }
    
    // Method untuk mendapatkan transaksi dengan detail yang selesai berdasarkan id_user
    public function getTransaksiWithDetailSelesai($id_user) {
        return $this->select('tbl_transaksi.*, tbl_user.nama, tbl_profil_usaha.nomor_rekening, tbl_profil_usaha.bank')
                    ->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id_user')  // Melakukan join dengan tabel tbl_user
                    ->join('tbl_profil_usaha', 'tbl_transaksi.id_user = tbl_profil_usaha.id_user')  // Melakukan join dengan tabel tbl_profil_usaha
                    ->where('tbl_transaksi.status', 'Selesai')  // Kondisi berdasarkan status 'Selesai'
                    ->where('tbl_transaksi.id_user', $id_user)  // Kondisi berdasarkan id_user
                    ->findAll();  // Mengembalikan semua hasil query
    }
    
    // Method untuk mendapatkan konfirmasi transaksi dengan detail yang selesai
    public function getKonfirmasiTransaksiWithDetailSelesai() {
        return $this->select('tbl_transaksi.*, tbl_user.nama, tbl_profil_usaha.nomor_rekening, tbl_profil_usaha.bank')
                    ->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id_user')  // Melakukan join dengan tabel tbl_user
                    ->join('tbl_profil_usaha', 'tbl_transaksi.id_user = tbl_profil_usaha.id_user')  // Melakukan join dengan tabel tbl_profil_usaha
                    ->where('tbl_transaksi.status', 'Selesai')  // Kondisi berdasarkan status 'Selesai'
                    ->findAll();  // Mengembalikan semua hasil query
    }
    
    // Method untuk menghapus data transaksi berdasarkan id_transaksi
    public function DeleteData($data)
    {
        $deleted = $this->db->table('tbl_transaksi')
                            ->where('id_transaksi', $data['id_transaksi'])  // Kondisi berdasarkan id_transaksi
                            ->delete();  // Menghapus data transaksi
    
        return $deleted;  // Mengembalikan status penghapusan data transaksi
    }
    


    

}
