<?php

namespace App\Controllers;

use App\Models\ModelAkun; // Mengimpor model akun
use App\Models\ModelTransaksi; // Mengimpor model transaksi
use App\Models\ModelProfilUsaha; // Mengimpor model profil usaha

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->ModelAkun = new ModelAkun(); // Membuat instance dari model akun
        $this->ModelProfilUsaha = new ModelProfilUsaha(); // Membuat instance dari model profil usaha
        $this->ModelTransaksi = new ModelTransaksi(); // Membuat instance dari model transaksi
    }

    public function index()
    {   
        $id_user = session()->get('id_user'); // Mendapatkan id_user dari session
        
        // Mengambil total harga transaksi hari ini, jika id_user adalah 10 (admin), ambil semua data, jika bukan, ambil data berdasarkan id_user
        $totalHargaHariIni = ($id_user == 10) 
            ? $this->ModelTransaksi->getTotalHargaHariIni() 
            : $this->ModelTransaksi->getTotalHargaHariIni($id_user);

        // Mengambil total harga transaksi bulan ini, jika id_user adalah 10 (admin), ambil semua data, jika bukan, ambil data berdasarkan id_user
        $totalHargaBulanIni = ($id_user == 10) 
            ? $this->ModelTransaksi->getTotalHargaBulanIni() 
            : $this->ModelTransaksi->getTotalHargaBulanIni($id_user);

        // Mengambil total harga transaksi tahun ini, jika id_user adalah 10 (admin), ambil semua data, jika bukan, ambil data berdasarkan id_user
        $totalHargaTahunIni = ($id_user == 10) 
            ? $this->ModelTransaksi->getTotalHargaTahunIni() 
            : $this->ModelTransaksi->getTotalHargaTahunIni($id_user);

        // Mengambil total harga keseluruhan transaksi, jika id_user adalah 10 (admin), ambil semua data, jika bukan, ambil data berdasarkan id_user
        $totalHargaTotalHargaKeseluruhan = ($id_user == 10) 
            ? $this->ModelTransaksi->getTotalHargaKeseluruhan() 
            : $this->ModelTransaksi->getTotalHargaKeseluruhan($id_user);

        // Menghitung jumlah transaksi dalam proses, jika id_user adalah 10 (admin), ambil semua data, jika bukan, ambil data berdasarkan id_user
        $totalTransaksiProses = ($id_user == 10) 
            ? $this->ModelTransaksi->hitungTransaksiProses() 
            : $this->ModelTransaksi->hitungTransaksiProses($id_user);
            
        // Menghitung jumlah transaksi yang diterima, jika id_user adalah 10 (admin), ambil semua data, jika bukan, ambil data berdasarkan id_user
        $totalTransaksiDiterima = ($id_user == 10) 
            ? $this->ModelTransaksi->hitungTransaksiDiterima() 
            : $this->ModelTransaksi->hitungTransaksiDiterima($id_user);

        // Menghitung jumlah transaksi yang selesai, jika id_user adalah 10 (admin), ambil semua data, jika bukan, ambil data berdasarkan id_user
        $totalTransaksiSelesai = ($id_user == 10) 
            ? $this->ModelTransaksi->hitungTransaksiSelesai() 
            : $this->ModelTransaksi->hitungTransaksiSelesai($id_user);

        // Mengambil total harga grup pengusaha, jika id_user adalah 10 (admin), ambil semua data, jika bukan, ambil data berdasarkan id_user
        $users = ($id_user == 10)
            ? $this->ModelTransaksi->getTotalHargaGrupPengusaha()
            : $this->ModelTransaksi->getTotalHargaGrupPengusaha($id_user);

        $data = [
            'menu' => 'dashboard', // Menetapkan menu aktif menjadi dashboard
            'judul' => 'Dashboard', // Menetapkan judul halaman
            'page' => 'v_dashboard', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' =>  $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' =>  $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'jumlahPengusahaLevel2' => $this->ModelAkun->hitungPengusahaLevel2(), // Menghitung jumlah pengusaha level 2
            'jumlahTransaksiProses' => $totalTransaksiProses, // Jumlah transaksi yang sedang diproses
            'jumlahTransaksiDiterima' => $totalTransaksiDiterima, // Jumlah transaksi yang diterima
            'jumlahTransaksiSelesai' => $totalTransaksiSelesai, // Jumlah transaksi yang selesai
            'jumlahTotalHargaHariIni' => $totalHargaHariIni, // Total harga transaksi hari ini
            'jumlahTotalHargaBulanIni' => $totalHargaBulanIni, // Total harga transaksi bulan ini
            'jumlahTotalHargaTahunIni' => $totalHargaTahunIni, // Total harga transaksi tahun ini
            'jumlahTotalHargaKeseluruhan' => $totalHargaTotalHargaKeseluruhan, // Total harga keseluruhan transaksi
            'users' => $users, // Data pengguna
        ];
        return view('v_template_back_end.php', $data); // Memuat tampilan template back end dengan data yang telah ditetapkan
    }
}
