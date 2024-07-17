<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKegiatan extends Model
{
    use HasFactory;
    protected $table = 'data_kegiatan';
    protected $primary_key = 'id';
    protected $fillable = [
        'nama_kegiatan', 'keterangan', 'tanggal_mulai', 'tanggal_selesai', 'lokasi', 'penanggung_jawab', 'status'
    ];
}
