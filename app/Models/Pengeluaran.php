<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'kategori_id',
        'pemasukan_id',
        'pengeluaran',
        'catatan',
        'tanggal',
        'jam',
    ];
}
