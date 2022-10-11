<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tampilan extends Model
{
    use HasFactory;

    protected $table = 'tampilan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kios', 'nama_tampilan', 'format_tampilan', 'created_at', 'updated_at'];
}
