<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\ArsipModel;

class KategoriController extends BaseController
{
    public function index()
    {
        $model = new KategoriModel();
        $data['kategori'] = $model->findAll();
        return view('admin/kategori', $data);
    }

    public function tambah()
    {
        return view('admin/tambah_kategori');
    }

    public function simpan()
    {
        $model = new KategoriModel();
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];
        $model->insert($data);
        return redirect()->to('/admin/kategori');
    }

    public function hapus($id)
    {
        $model = new KategoriModel();

        // Cek apakah kategori dengan ID tersebut ada
        $kategori = $model->find($id);
        if (!$kategori) {
            return redirect()->to('/admin/kategori')->with('error', 'Kategori tidak ditemukan!');
        }

        // Pastikan tidak ada arsip yang menggunakan kategori ini
        $arsipModel = new ArsipModel();
        $arsip = $arsipModel->where('kategori_id', $id)->first();
        if ($arsip) {
            return redirect()->to('/admin/kategori')->with('error', 'Kategori ini masih digunakan dalam data arsip!');
        }

        // Hapus kategori
        $model->delete($id);
        return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil dihapus!');
    }

    public function edit($id)
    {
        $model = new KategoriModel();

        // Ambil data kategori berdasarkan ID
        $data['kategori'] = $model->find($id);
        if (!$data['kategori']) {
            return redirect()->to('/admin/kategori')->with('error', 'Kategori tidak ditemukan!');
        }

        return view('admin/edit_kategori', $data);
    }

    public function update($id)
    {
        $model = new KategoriModel();

        // Validasi data input
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        $model->update($id, $data);
        return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil diperbarui!');
    }
}
