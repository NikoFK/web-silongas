<?php

namespace App\Models;

use CodeIgniter\Model; // Mengimpor kelas Model dari CodeIgniter

class ModelDetailTransaksi extends Model
{
    protected $table = 'tbl_detail_transaksi'; // Mendefinisikan nama tabel database
    protected $primaryKey = 'id_detail_transaksi'; // Mendefinisikan primary key tabel
    protected $allowedFields = ['id_transaksi', 'jenis_limbah', 'berat_benda', 'harga_kiloan', 'tanggal']; // Mendefinisikan field-field yang diperbolehkan untuk operasi insert/update

    // Method untuk menyisipkan (insert) data detail transaksi
    public function insertDetailTransaksi($data)
    {
        return $this->insert($data); // Memanggil method insert dari kelas Model untuk menyisipkan data ke tabel $table
    }

    // Method untuk mendapatkan detail transaksi berdasarkan id_transaksi
    public function getDetailTransaksi($id_transaksi) {
        return $this->db->table('tbl_detail_transaksi dt') // Memilih tabel 'tbl_detail_transaksi' dengan alias 'dt'
                        ->select('t.total_harga, t.bukti_pembayaran, dt.jenis_limbah, dt.harga_kiloan, dt.tanggal as detail_tanggal, dt.berat_benda') // Memilih kolom-kolom yang akan diambil dari tabel
                        ->join('tbl_transaksi t', 't.id_transaksi = dt.id_transaksi') // Melakukan inner join dengan tabel 'tbl_transaksi' berdasarkan kolom 'id_transaksi'
                        ->where('dt.id_transaksi', $id_transaksi) // Mencocokkan hasil join berdasarkan kolom 'id_transaksi'
                        ->get() // Melakukan eksekusi query dan mengambil hasilnya
                        ->getResultArray(); // Mengembalikan hasil query dalam bentuk array asosiatif dari semua baris hasil
    }
}
