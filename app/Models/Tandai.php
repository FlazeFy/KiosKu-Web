<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tandai extends Model
{
    use HasFactory;

    protected $table = 'tandai';
    protected $primaryKey = 'id_tandai';
    protected $fillable = ['id_kios', 'id_context', 'type_context', 'created_at', 'updated_at'];
}
