<?php

namespace App\Controllers;

use App\Models\ModelAkun; // Mengimpor model akun
use App\Models\ModelProfilUsaha; // Mengimpor model profil usaha
use App\Models\ModelTransaksi; // Mengimpor model transaksi
use App\Models\ModelDetailTransaksi; // Mengimpor model detail transaksi

class Pengajuan extends BaseController
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
        $id_user = session()->get('id_user');
        $data = [
            'menu' => 'pengajuan', // Menetapkan menu yang aktif
            'judul' => 'Pengajuan', // Menetapkan judul halaman
            'page' => 'v_pengajuan', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' => $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' => $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'transaksi' => $this->ModelTransaksi->getTransaksiWithDetailProses($id_user), // Mengambil transaksi dengan status "Proses"
        ];
        // Memuat tampilan template back end dengan data yang telah ditetapkan
        return view('v_template_back_end.php', $data);
    }

    public function Diterima()
    {
        $id_user = session()->get('id_user');
        $data = [
            'menu' => 'diterima', // Menetapkan menu yang aktif
            'judul' => 'Pengajuan Diterima', // Menetapkan judul halaman
            'page' => 'v_pengajuan_diterima', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' => $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' => $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'transaksi' => $this->ModelTransaksi->getTransaksiWithDetailDiterima($id_user), // Mengambil transaksi dengan status "Diterima"
        ];
        // Memuat tampilan template back end dengan data yang telah ditetapkan
        return view('v_template_back_end.php', $data);
    }

    public function Selesai()
    {
        $id_user = session()->get('id_user');
        $data = [
            'menu' => 'selesai', // Menetapkan menu yang aktif
            'judul' => 'Pengajuan Selesai', // Menetapkan judul halaman
            'page' => 'v_pengajuan_selesai', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' => $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' => $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'transaksi' => $this->ModelTransaksi->getTransaksiWithDetailSelesai($id_user), // Mengambil transaksi dengan status "Selesai"
        ];
        // Memuat tampilan template back end dengan data yang telah ditetapkan
        return view('v_template_back_end.php', $data);
    }

    public function pengajuan()
    {
        $transaksiModel = new ModelTransaksi();
        $detailTransaksiModel = new ModelDetailTransaksi();

        $id_user = session()->get('id_user');
        $tanggal = date('Y-m-d H:i:s');

        // Generate invoice otomatis
        $invoice = 'INV-' . date('YmdHis');

        // Insert ke tbl_transaksi
        $dataTransaksi = [
            'id_user' => $id_user,
            'invoice' => $invoice,
            'status' => 'Proses',
            'total_harga' => $this->request->getPost('total_harga'),
            'tanggal' => $tanggal
        ];
        $id_transaksi = $transaksiModel->insertTransaksi($dataTransaksi);

        // Insert ke tbl_detail_transaksi
        $dataDetailTransaksi = [
            'id_transaksi' => $id_transaksi,
            'jenis_limbah' => $this->request->getPost('jenis_limbah'),
            'berat_benda' => $this->request->getPost('berat_benda'),
            'harga_kiloan' => $this->request->getPost('harga_kiloan'),
            'tanggal' => $tanggal
        ];
        $detailTransaksiModel->insertDetailTransaksi($dataDetailTransaksi);

        session()->setFlashdata('sukses', 'Pengajuan Transaksi Berhasil');
        return redirect()->to('pengajuan');
    }

    public function detail($id_transaksi)
    {
        $model = new ModelDetailTransaksi();
        $data['detail'] = $model->getDetailTransaksi($id_transaksi);
        echo json_encode($data);
    }

    public function DeleteData()
    {
        $model = new ModelTransaksi();
        $id_transaksi = $this->request->getPost('id_transaksi');

        if ($model->DeleteData(['id_transaksi' => $id_transaksi])) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error'], 500);
        }
    }
}
