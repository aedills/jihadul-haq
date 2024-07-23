<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOutcome extends Model
{
    use HasFactory;
    protected $table = 'keuangan_outcome';
    protected $primary_key = 'id';
    protected $fillable = [
        'jenis_pengeluaran', 'tanggal', 'nominal', 'tujuan_pengeluaran', 'keterangan'
    ];
}
