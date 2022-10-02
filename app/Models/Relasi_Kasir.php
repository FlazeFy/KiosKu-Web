<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi_Kasir extends Model
{
    use HasFactory;

    protected $table = 'relasi_kasir';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kasir', 'id_karyawan', 'created_at'];
}
