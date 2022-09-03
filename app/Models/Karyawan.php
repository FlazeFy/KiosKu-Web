<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kios', 'nama_karyawan', 'nama_lengkap_karyawan', 'email_karyawan', 'ponsel_karyawan', 'jabatan_karyawan', 'status_karyawan', 'gaji_karyawan', 'karyawan_image_url', 'created_at', 'updated_at'];
}
