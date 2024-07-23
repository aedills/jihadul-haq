<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MQurbanDetail extends Model
{
    use HasFactory;
    protected $table = 'data_qurban_detail';
    protected $primary_key = 'id';
    protected $fillable = [
        'id_qurban', 'nama_pembayar', 'tgl_bayar', 'nominal',
    ];
}
