<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi_Rak extends Model
{
    use HasFactory;

    protected $table = 'relasi_rak';
    protected $primaryKey = 'id';
    protected $fillable = ['id_barang', 'id_rak', 'created_at'];
}
