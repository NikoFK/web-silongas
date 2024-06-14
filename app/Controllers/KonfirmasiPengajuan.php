<?php

namespace App\Controllers;

use App\Models\ModelAkun; // Mengimpor model akun
use App\Models\ModelProfilUsaha; // Mengimpor model profil usaha
use App\Models\ModelTransaksi; // Mengimpor model transaksi
use App\Models\ModelDetailTransaksi; // Mengimpor model detail transaksi

class KonfirmasiPengajuan extends BaseController
{
    public function __construct()
    {
        // Membuat instance dari masing-masing model dan menyimpannya dalam properti kelas
        $this->ModelAkun = new ModelAkun(); 
        $this->ModelProfilUsaha = new ModelProfilUsaha();
        $this->ModelTransaksi = new ModelTransaksi();
    }

    public function index()
    {
        // Menyiapkan data yang akan dikirim ke view
        $data = [
            'menu' => 'k_pengajuan', // Menetapkan menu yang aktif
            'judul' => 'Konfirmasi Pengajuan', // Menetapkan judul halaman
            'page' => 'v_k_pengajuan', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' =>  $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' =>  $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'transaksi' =>  $this->ModelTransaksi->getKonfirmasiTransaksiWithDetailProses(), // Mengambil transaksi yang perlu dikonfirmasi dengan detail
        ];
        // Memuat tampilan template back end dengan data yang telah ditetapkan
        return view('v_template_back_end.php', $data);
    }

    public function Diterima()
    {
        // Menyiapkan data untuk halaman konfirmasi pengajuan diterima
        $data = [
            'menu' => 'k_diterima', // Menetapkan menu yang aktif
            'judul' => 'Konfirmasi Pengajuan Diterima', // Menetapkan judul halaman
            'page' => 'v_k_pengajuan_diterima', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' =>  $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' =>  $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'transaksi' =>  $this->ModelTransaksi->getKonfirmasiTransaksiWithDetailDiterima(), // Mengambil transaksi yang telah diterima dengan detail
        ];
        // Memuat tampilan template back end dengan data yang telah ditetapkan
        return view('v_template_back_end.php', $data);
    }

    public function Selesai()
    {
        // Menyiapkan data untuk halaman konfirmasi pengajuan selesai
        $data = [
            'menu' => 'k_selesai', // Menetapkan menu yang aktif
            'judul' => 'Konfirmasi Pengajuan Selesai', // Menetapkan judul halaman
            'page' => 'v_k_pengajuan_selesai', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' =>  $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' =>  $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'transaksi' =>  $this->ModelTransaksi->getKonfirmasiTransaksiWithDetailSelesai(), // Mengambil transaksi yang telah selesai dengan detail
        ];
        // Memuat tampilan template back end dengan data yang telah ditetapkan
        return view('v_template_back_end.php', $data);
    }

    public function KonfirmasiProsesPengajuan() {
        $model = new ModelTransaksi(); // Membuat instance dari model transaksi
        $id_transaksi = $this->request->getPost('id_transaksi'); // Mengambil ID transaksi dari POST request

        // Mengupdate status transaksi menjadi "Diterima"
        if ($model->UpdateStatusDiterima($id_transaksi, 'Diterima')) {
            // Mengembalikan respons JSON sukses
            return $this->response->setJSON(['status' => 'success', 'message' => 'Transaksi berhasil diterima']);
        } else {
            // Mengembalikan respons JSON error
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengupdate status transaksi']);
        }
    }

    public function KonfirmasiSelesaiPengajuan() {
        $id_transaksi = $this->request->getPost('id_transaksi'); // Mengambil ID transaksi dari POST request
        $bukti_pembayaran = $this->request->getFile('bukti_pembayaran'); // Mengambil file bukti pembayaran dari POST request
    
        // Memeriksa apakah file bukti pembayaran valid dan belum dipindahkan
        if ($bukti_pembayaran->isValid() && !$bukti_pembayaran->hasMoved()) {
            // Menghasilkan nama file baru secara acak
            $newFileName = $bukti_pembayaran->getRandomName();
            // Memindahkan file ke direktori yang diinginkan
            $bukti_pembayaran->move(ROOTPATH . 'public/bukti-pembayaran', $newFileName);
    
            // Menyiapkan data untuk update
            $data = [
                'status' => 'Selesai', // Mengatur status menjadi "Selesai"
                'bukti_pembayaran' => $newFileName // Menyimpan nama file bukti pembayaran baru
            ];
    
            // Mengupdate status transaksi dan bukti pembayaran di database
            $model = new ModelTransaksi();
            if ($model->update($id_transaksi, $data)) {
                // Mengembalikan respons JSON sukses
                return $this->response->setJSON(['status' => 'success', 'message' => 'Transaksi berhasil diselesaikan']);
            } else {
                // Mengembalikan respons JSON error jika update gagal
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengupdate status transaksi']);
            }
        } else {
            // Mengembalikan respons JSON error jika upload bukti pembayaran gagal
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengupload bukti pembayaran'], 400);
        }
    }
}
