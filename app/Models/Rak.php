<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'rak';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kios', 'nama_rak', 'deskripsi_rak', 'created_at', 'updated_at'];
}
