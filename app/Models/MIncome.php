<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MIncome extends Model
{
    use HasFactory;
    protected $table = 'keuangan_income';
    protected $primary_key = 'id';
    protected $fillable = [
        'jenis_pemasukan', 'tanggal', 'nominal', 'sumber_pemasukan', 'keterangan'
    ];
}
