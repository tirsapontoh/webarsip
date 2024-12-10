<?php

namespace App\Controllers;

use App\Models\ArsipModel;
use App\Models\KategoriModel;
use App\Models\MahasiswaModel;

class ArsipController extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();

        $data['arsip'] = $model
            ->select('arsip.*, kategori.nama_kategori AS kategori, mahasiswa.nama AS mahasiswa_nama')
            ->join('kategori', 'kategori.id = arsip.kategori_id')
            ->join('mahasiswa', 'mahasiswa.id = arsip.mahasiswa_id')
            ->findAll();

        return view('admin/arsip', $data);
    }

    public function tambah()
    {
        $kategoriModel = new KategoriModel();
        $mahasiswaModel = new MahasiswaModel();

        $data['kategori'] = $kategoriModel->findAll(); // Ambil semua kategori
        $data['mahasiswa'] = $mahasiswaModel->findAll(); // Ambil semua mahasiswa

        return view('admin/tambah_arsip', $data);
    }

    public function simpan()
    {
        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $file->move('uploads', $fileName); // Simpan file di folder uploads

        $model = new ArsipModel();
        $data = [
            'judul'        => $this->request->getPost('judul'),
            'kategori_id'  => $this->request->getPost('kategori_id'),
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'file'         => $fileName,
            'tanggal'      => $this->request->getPost('tanggal'),
        ];

        $model->insert($data);
        return redirect()->to('/admin/arsip')->with('success', 'Arsip berhasil ditambahkan!');
    }


    public function hapus($id)
    {
        $model = new ArsipModel();

        // Cek apakah arsip dengan ID tersebut ada
        $arsip = $model->find($id);
        if (!$arsip) {
            return redirect()->to('/admin/arsip')->with('error', 'Data arsip tidak ditemukan!');
        }

        // Hapus file dari folder uploads
        if (file_exists('uploads/' . $arsip['file'])) {
            unlink('uploads/' . $arsip['file']);
        }

        // Hapus data dari database
        $model->delete($id);
        return redirect()->to('/admin/arsip')->with('success', 'Data arsip berhasil dihapus!');
    }

    public function edit($id)
    {
        $model = new ArsipModel();
        $kategoriModel = new KategoriModel();

        // Ambil data arsip berdasarkan ID
        $data['arsip'] = $model->find($id);
        if (!$data['arsip']) {
            return redirect()->to('/admin/arsip')->with('error', 'Data arsip tidak ditemukan!');
        }

        // Ambil daftar kategori untuk dropdown
        $data['kategori'] = $kategoriModel->findAll();

        return view('admin/edit_arsip', $data);
    }

    public function update($id)
    {
        $model = new ArsipModel();

        // Ambil file baru jika ada
        $file = $this->request->getFile('file');
        $arsip = $model->find($id);
        $fileName = $arsip['file']; // Gunakan file lama jika tidak ada file baru

        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);

            // Hapus file lama
            if (file_exists('uploads/' . $arsip['file'])) {
                unlink('uploads/' . $arsip['file']);
            }
        }

        // Validasi data input
        $data = [
            'judul'      => $this->request->getPost('judul'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'file'       => $fileName,
            'tanggal'    => $this->request->getPost('tanggal'),
        ];

        $model->update($id, $data);
        return redirect()->to('/admin/arsip')->with('success', 'Data arsip berhasil diperbarui!');
    }
}
