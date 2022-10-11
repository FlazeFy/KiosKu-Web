<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kios', 'nama_jabatan', 'deskripsi_jabatan', 'created_at', 'updated_at'];
}
