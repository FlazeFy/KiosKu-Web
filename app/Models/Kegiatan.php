<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kios', 'assignee', 'kegiatan_title', 'kegiatan_desc', 'kegiatan_type', 'kegiatan_url', 'waktu_mulai', 'waktu_selesai', 'created_at', 'updated_at'];
}
