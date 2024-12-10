<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    public function index()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->findAll();
        return view('admin/mahasiswa', $data);
    }

    public function tambah()
    {
        return view('admin/tambah_mahasiswa');
    }

    public function simpan()
    {
        $model = new MahasiswaModel();
        $data = [
            'nim'      => $this->request->getPost('nim'),
            'nama'     => $this->request->getPost('nama'),
            'jurusan'  => $this->request->getPost('jurusan'),
            'angkatan' => $this->request->getPost('angkatan'),
        ];
        $model->insert($data);
        return redirect()->to('/admin/mahasiswa');
    }

    public function hapus($id)
    {
        $model = new MahasiswaModel();

        // Cek apakah mahasiswa dengan ID tersebut ada
        $mahasiswa = $model->find($id);
        if (!$mahasiswa) {
            return redirect()->to('/admin/mahasiswa')->with('error', 'Data mahasiswa tidak ditemukan!');
        }

        // Hapus data
        $model->delete($id);
        return redirect()->to('/admin/mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus!');
    }

    public function edit($id)
    {
        $model = new MahasiswaModel();

        // Ambil data mahasiswa berdasarkan ID
        $data['mahasiswa'] = $model->find($id);
        if (!$data['mahasiswa']) {
            return redirect()->to('/admin/mahasiswa')->with('error', 'Data mahasiswa tidak ditemukan!');
        }

        return view('admin/edit_mahasiswa', $data);
    }

    public function update($id)
    {
        $model = new MahasiswaModel();

        // Validasi data input
        $data = [
            'nim'      => $this->request->getPost('nim'),
            'nama'     => $this->request->getPost('nama'),
            'jurusan'  => $this->request->getPost('jurusan'),
            'angkatan' => $this->request->getPost('angkatan'),
        ];

        $model->update($id, $data);
        return redirect()->to('/admin/mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }
}
