<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MJamaah extends Model
{
    use HasFactory;
    protected $table = 'data_jamaah';
    protected $primary_key = 'id';
    protected $fillable = [
        'nama', 'alamat', 'no_hp', 'p4ss', 'gender', 'tempat_lahir', 'tanggal_lahir', 'pekerjaan'
    ];
}
