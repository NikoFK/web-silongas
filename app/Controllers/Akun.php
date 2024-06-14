<?php

namespace App\Controllers;

use App\Models\ModelAkun; // Mengimpor model akun
use App\Models\ModelProfilUsaha; // Mengimpor model profil usaha

class Akun extends BaseController
{
    public function __construct()
    {
        $this->ModelAkun = new ModelAkun(); // Membuat instance dari model akun
        $this->ModelProfilUsaha = new ModelProfilUsaha(); // Membuat instance dari model profil usaha
    }

    public function index()
    {
        $data = [
            'judul' => 'Akun', // Menetapkan judul halaman
            'menu' => 'akun', // Menetapkan menu aktif
            'page' => 'v_akun', // Menetapkan halaman yang akan ditampilkan
            'atributKosong' =>  $this->ModelAkun->hitungAtributKosong(), // Mengambil jumlah atribut kosong dari model akun
            'atributKosongProfilUsaha' =>  $this->ModelProfilUsaha->hitungAtributKosongProfilUsaha(), // Mengambil jumlah atribut kosong dari model profil usaha
        ];
        return view('v_template_back_end.php', $data); // Memuat tampilan template backend dengan data yang telah ditetapkan
    }

    public function updateData()
    {
        // Memvalidasi input form untuk file foto
        if (!$this->validate([
            'foto' => [
                'rules' => 'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto, 2048]', // Validasi tipe dan ukuran file
                'errors' => [
                    'max_size' => 'Ukuran File Maksimal 2 MB', // Pesan error untuk ukuran file
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png | Ukuran Maks 2mb', // Pesan error untuk tipe file
                ]
            ]
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors()); // Menyimpan pesan error ke session
            return redirect()->back()->withInput(); // Mengembalikan ke halaman sebelumnya dengan input yang telah diisi
        } else {
            // Menyimpan data dari form ke session
            session()->set([
                'ttl' => $this->request->getPost('ttl'), // Menyimpan ttl ke session
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'), // Menyimpan jenis kelamin ke session
                'email' => $this->request->getPost('email'), // Menyimpan email ke session
                'no_hp' => $this->request->getPost('no_hp'), // Menyimpan nomor HP ke session
                'alamat' => $this->request->getPost('alamat'), // Menyimpan alamat ke session
                'tentang_aku' => $this->request->getPost('tentang_aku'), // Menyimpan tentang aku ke session
                'foto' => session()->get('foto'), // Simpan foto dari session jika masih ada
            ]);

            // Mendapatkan data dari form
            $data = [
                'ttl' => $this->request->getPost('ttl'), // Mendapatkan ttl dari form
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'), // Mendapatkan jenis kelamin dari form
                'email' => $this->request->getPost('email'), // Mendapatkan email dari form
                'no_hp' => $this->request->getPost('no_hp'), // Mendapatkan nomor HP dari form
                'alamat' => $this->request->getPost('alamat'), // Mendapatkan alamat dari form
                'tentang_aku' => $this->request->getPost('tentang_aku'), // Mendapatkan tentang aku dari form
            ];

            // Mendapatkan foto yang diunggah
            $foto = $this->request->getFile('foto');

            // Jika ada file foto yang diunggah
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                // Hapus foto lama jika ada
                $oldFotoName = session()->get('foto');
                if ($oldFotoName && file_exists(ROOTPATH . 'public/foto/' . $oldFotoName)) {
                    unlink(ROOTPATH . 'public/foto/' . $oldFotoName); // Menghapus file foto lama
                }

                // Pindahkan foto baru ke direktori yang diinginkan
                $newFotoName = $foto->getRandomName(); // Membuat nama acak untuk file foto baru
                $foto->move(ROOTPATH . 'public/foto', $newFotoName); // Memindahkan file foto ke direktori

                // Simpan nama file foto baru ke dalam data yang akan diupdate
                $data['foto'] = $newFotoName;

                // Perbarui nilai sesi 'foto'
                session()->set('foto', $newFotoName); // Menyimpan nama file foto baru ke session
            }

            // Mendapatkan username dari session
            $username = session()->get('username');

            // Memperbarui data di database berdasarkan username
            $this->ModelAkun->updateData($username, $data);

            // Setelah berhasil diperbarui, mengatur pesan sukses menggunakan session flashdata
            session()->setFlashdata('sukses', 'Data berhasil diperbarui');
            return redirect()->to('akun'); // Mengarahkan kembali ke halaman akun
        }
    }

    public function DeleteData()
    {
        $model = new ModelAkun(); // Membuat instance dari model akun
        $id_user = $this->request->getPost('id_user'); // Mendapatkan id user dari form

        // Menghapus data akun berdasarkan id user
        if ($model->DeleteData(['id_user' => $id_user])) {
            return $this->response->setJSON(['status' => 'success']); // Mengembalikan respon JSON dengan status sukses
        } else {
            return $this->response->setJSON(['status' => 'error'], 500); // Mengembalikan respon JSON dengan status error
        }
    }
}
