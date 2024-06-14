<?php

namespace App\Controllers;

use App\Models\ModelAkun; // Mengimpor model akun
use App\Models\ModelProfilUsaha; // Mengimpor model profil usaha

class ProfilUsaha extends BaseController
{
    protected $ModelAkun; // Properti untuk menyimpan instance ModelAkun
    protected $ModelProfilUsaha; // Properti untuk menyimpan instance ModelProfilUsaha

    public function __construct()
    {
        // Inisialisasi model-model yang dibutuhkan melalui konstruktor
        $this->ModelAkun = new ModelAkun();
        $this->ModelProfilUsaha = new ModelProfilUsaha();
    }

    public function index()
    {
        // Menyiapkan data untuk dikirimkan ke view
        $data = [
            'menu' => 'profil_usaha', // Menu aktif
            'judul' => 'Profil Usaha', // Judul halaman
            'page' => 'v_profil_usaha', // Halaman yang akan ditampilkan
            'atributKosong' => $this->ModelAkun->hitungAtributKosong(), // Menghitung atribut kosong di akun
            'atributKosongProfilUsaha' => $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Menghitung atribut kosong di profil usaha
            'users' => $this->ModelProfilUsaha->AllData() // Mendapatkan semua data profil usaha
        ];

        // Memuat tampilan template back end dengan data yang telah ditetapkan
        return view('v_template_back_end.php', $data);
    }

    public function updateData()
    {
        // Validasi data yang dikirimkan melalui form
        if (!$this->validate([
            'foto_usaha' => [
                'rules' => 'mime_in[foto_usaha,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto_usaha,9048]',
                'errors' => [
                    'max_size' => 'Ukuran File Maksimal 9 MB',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png | Ukuran Maks 9mb',
                ]
            ]
        ])) {
            // Jika validasi gagal, set pesan error dan kembalikan ke halaman sebelumnya dengan data input yang dimasukkan
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            // Jika validasi berhasil, simpan data dari form ke dalam sesi
            session()->set([
                'nama_usaha' => $this->request->getPost('nama_usaha'),
                'deskripsi_usaha' => $this->request->getPost('deskripsi_usaha'),
                'lokasi_usaha' => $this->request->getPost('lokasi_usaha'),
                'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                'bank' => $this->request->getPost('bank'),
                'foto_usaha' => session()->get('foto_usaha'), // Simpan foto dari session jika masih ada
                // Tambahkan sesuai dengan session yang ingin Anda simpan
            ]);

            // Mendapatkan data dari form untuk disimpan di database
            $data = [
                'nama_usaha' => $this->request->getPost('nama_usaha'),
                'deskripsi_usaha' => $this->request->getPost('deskripsi_usaha'),
                'lokasi_usaha' => $this->request->getPost('lokasi_usaha'),
                'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                'bank' => $this->request->getPost('bank'),
            ];

            // Mendapatkan file foto yang diunggah
            $foto_usaha = $this->request->getFile('foto_usaha');

            // Jika ada file foto yang diunggah
            if ($foto_usaha && $foto_usaha->isValid() && !$foto_usaha->hasMoved()) {
                // Hapus foto lama jika ada
                $oldFotoName = session()->get('foto_usaha');
                if ($oldFotoName && file_exists(ROOTPATH . 'public/foto/' . $oldFotoName)) {
                    unlink(ROOTPATH . 'public/foto/' . $oldFotoName);
                }

                // Pindahkan foto baru ke direktori yang diinginkan dan beri nama baru acak
                $newFotoName = $foto_usaha->getRandomName();
                $foto_usaha->move(ROOTPATH . 'public/foto', $newFotoName);

                // Simpan nama file foto baru ke dalam data yang akan diupdate
                $data['foto_usaha'] = $newFotoName;

                // Perbarui nilai sesi 'foto_usaha' dengan nama file yang baru diunggah
                session()->set('foto_usaha', $newFotoName);
            }

            // Mendapatkan username dari sesi untuk mencari id_user
            $username = session()->get('username');

            // Mendapatkan id_user berdasarkan username
            $id_user = $this->ModelProfilUsaha->getIdUserByUsername($username);

            // Memperbarui data profil usaha di database berdasarkan id_user
            $this->ModelProfilUsaha->updateData($id_user, $data);

            // Setelah berhasil diperbarui, set pesan sukses menggunakan session flashdata
            session()->setFlashdata('sukses', 'Data berhasil diperbarui');

            // Redirect kembali ke halaman profil usaha
            return redirect()->to('ProfilUsaha');
        }
    }
}
