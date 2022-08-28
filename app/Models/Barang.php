<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kios', 'nama_barang', 'kategori_barang', 'harga_stok', 'harga_jual', 'deskripsi_barang', 'stok_barang', 'created_at', 'updated_at', 'expired_at'];
}
