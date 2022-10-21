<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat_Kios extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kios';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kios', 'konteks_riwayat', 'deskripsi_riwayat', 'created_at', 'updated_at'];
}
