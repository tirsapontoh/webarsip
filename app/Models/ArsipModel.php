<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipModel extends Model
{
    protected $table = 'arsip';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'file', 'kategori_id', 'mahasiswa_id', 'tanggal'];
}
