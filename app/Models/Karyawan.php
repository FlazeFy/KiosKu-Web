<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kios', 'nama_karyawan', 'nama_lengkap_karyawan', 'jabatan_karyawan', 'status_karyawan', 'gaji_karyawan', 'created_at', 'updated_at'];
}
