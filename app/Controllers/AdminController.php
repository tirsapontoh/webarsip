<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function dashboard()
    {
        $arsipModel = new \App\Models\ArsipModel();

        // Ambil data arsip beserta kategori dan mahasiswa
        $data['arsip'] = $arsipModel
            ->select('arsip.*, kategori.nama_kategori AS kategori, mahasiswa.nama AS mahasiswa_nama')
            ->join('kategori', 'kategori.id = arsip.kategori_id')
            ->join('mahasiswa', 'mahasiswa.id = arsip.mahasiswa_id')
            ->findAll();

        return view('admin/dashboard', $data);
    }
}
