<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    protected $table = 'kasir';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kios', 'nama_kasir', 'deskripsi_kasir',  'created_at', 'updated_at'];
}
