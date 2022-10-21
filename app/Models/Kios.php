<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kios extends Model
{
    use HasFactory;

    protected $table = 'kios';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password', 'nama_kios', 'kategori_kios', 'alamat_kios', 'kontak_kios', 'email_kios', 'deskripsi_kios', 'kios_image_url', 'status_akun_kios', 'created_at', 'updated_at'];
}
