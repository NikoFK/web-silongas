<?php

namespace App\Controllers;

use App\Controllers\BaseController; // Mengimpor BaseController
use App\Models\ModelAuth; // Mengimpor model auth
use App\Models\ModelAkun; // Mengimpor model akun

class Auth extends BaseController
{

    public function __construct()
    {
        $this->ModelAuth = new ModelAuth(); // Membuat instance dari model auth
        $this->ModelAkun = new ModelAkun(); // Membuat instance dari model akun
    }

    public function index()
    {
        $data = [
            'judul' => 'Login', // Menetapkan judul halaman
            'page' => 'v_login', // Menetapkan halaman yang akan ditampilkan
        ];
        return view('v_template_login_registrasi', $data); // Memuat tampilan template login dan registrasi dengan data yang telah ditetapkan
    }

    public function Login()
    {
        $username = $this->request->getPost('username'); // Mendapatkan username dari form
        $password = $this->request->getPost('password'); // Mendapatkan password dari form
        $level = $this->request->getPost('level'); // Mendapatkan level dari form
        
        // Pastikan $username dan $level tidak kosong
        if (!empty($username) && ($level == 1 || $level == 2)) {
            $cek = $this->ModelAuth->LoginUser($username, $level); // Memeriksa pengguna di database berdasarkan username dan level
            // Pastikan data pengguna ada
            if ($cek) {
                // Verifikasi password dengan password_verify
                if (password_verify($password, $cek['password'])) {
                    // Ambil data profil usaha berdasarkan id_user
                    $profilUsaha = $this->ModelAuth->getProfilUsahaByIdUser($cek['id_user']);
                    
                    // Jika profil usaha tidak ditemukan, buat entri baru
                    if (!$profilUsaha) {
                        $this->ModelAuth->insertProfilUsaha($cek['id_user']); // Menambahkan data profil usaha baru
                        $profilUsaha = $this->ModelAuth->getProfilUsahaByIdUser($cek['id_user']); // Mengambil data profil usaha yang baru dibuat
                    }
                    
                    // Set session dari tbl_user
                    session()->set('id_user', $cek['id_user']); // Menyimpan id_user ke session
                    session()->set('nama', $cek['nama']); // Menyimpan nama ke session
                    session()->set('level', $level); // Menyimpan level ke session
                    session()->set('username', $cek['username']); // Menyimpan username ke session
                    session()->set('email', $cek['email']); // Menyimpan email ke session
                    session()->set('foto', $cek['foto']); // Menyimpan foto ke session
                    session()->set('ttl', $cek['ttl']); // Menyimpan ttl ke session
                    session()->set('jenis_kelamin', $cek['jenis_kelamin']); // Menyimpan jenis kelamin ke session
                    session()->set('no_hp', $cek['no_hp']); // Menyimpan no_hp ke session
                    session()->set('alamat', $cek['alamat']); // Menyimpan alamat ke session
                    session()->set('tentang_aku', $cek['tentang_aku']); // Menyimpan tentang aku ke session
                    
                    // Set session dari tbl_profil_usaha
                    session()->set('nama_usaha', $profilUsaha['nama_usaha']); // Menyimpan nama_usaha ke session
                    session()->set('lokasi_usaha', $profilUsaha['lokasi_usaha']); // Menyimpan lokasi_usaha ke session
                    session()->set('nomor_rekening', $profilUsaha['nomor_rekening']); // Menyimpan nomor_rekening ke session
                    session()->set('bank', $profilUsaha['bank']); // Menyimpan bank ke session
                    session()->set('deskripsi_usaha', $profilUsaha['deskripsi_usaha']); // Menyimpan deskripsi_usaha ke session
                    session()->set('foto_usaha', $profilUsaha['foto_usaha']); // Menyimpan foto_usaha ke session
                    
                    // Redirect ke dashboard jika login berhasil
                    return redirect()->to('dashboard');
                } else {
                    // Set pesan flash jika password tidak cocok
                    session()->setFlashdata('gagal', 'Password salah');
                }
            } else {
                // Set pesan flash jika pengguna tidak ditemukan
                session()->setFlashdata('gagal', 'Pengguna tidak ditemukan');
            }
        } else {
            // Set pesan flash jika input tidak valid
            session()->setFlashdata('gagal', 'Input tidak valid');
        }
        // Redirect kembali ke halaman login jika login gagal
        return redirect()->to('Auth');
    }

    public function registrasi()
    {
        $data = [
            'judul' => 'Registrasi Pengusaha', // Menetapkan judul halaman
            'page' => 'v_registrasi', // Menetapkan halaman yang akan ditampilkan
        ];
        return view('v_template_login_registrasi', $data); // Memuat tampilan template login dan registrasi dengan data yang telah ditetapkan
    }

    public function InsertData()
    {
        // Memvalidasi input form untuk password dan konfirmasi password
        if (!$this->validate([
            'passwordsignin' => [
                'rules' => 'required', // Validasi password harus diisi
                'errors' => [
                    'required' => 'Password wajib diisi', // Pesan error untuk password
                ]
            ],
            'confirmpassword' => [
                'rules' => 'required|matches[passwordsignin]', // Validasi konfirmasi password harus diisi dan harus sama dengan password
                'errors' => [
                    'required' => 'Konfirmasi password wajib diisi', // Pesan error untuk konfirmasi password
                    'matches' => 'Password Tidak Sesuai' // Pesan error jika password tidak cocok
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors()); // Menyimpan pesan error ke session
            return redirect()->back()->withInput(); // Mengembalikan ke halaman sebelumnya dengan input yang telah diisi
        } else {
            // Menyimpan data dari form ke dalam array
            $data = [
                'nama' => $this->request->getPost('nama'), // Mendapatkan nama dari form
                'level' => 2, // Menetapkan level user
                'foto' => "default-foto-profil.png", // Menetapkan foto default
                'username' => $this->request->getPost('username'), // Mendapatkan username dari form
                'email' => $this->request->getPost('email'), // Mendapatkan email dari form
                'password' => password_hash($this->request->getPost('confirmpassword'), PASSWORD_BCRYPT), // Mengenkripsi password
            ];
            $this->ModelAkun->InsertData($data); // Memasukkan data user ke database
            session()->setFlashdata('sukses', 'User Berhasil Ditambahkan'); // Menyimpan pesan sukses ke session
            return redirect()->to('auth'); // Mengarahkan kembali ke halaman auth
        }
    }

    public function Logout()
    {
        // Hapus semua session
        session()->destroy();
        return redirect()->to('Auth'); // Mengarahkan kembali ke halaman auth
    }
}
