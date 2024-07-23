<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MQurban extends Model
{
    use HasFactory;
    protected $table = 'data_qurban';
    protected $primary_key = 'id';
    protected $fillable = [
        'nama_penanggungjawab', 'status', 'tgl_mulai', 'total_terbayar', 'target_total'
    ];

    public function detail()
    {
        return $this->hasMany(MQurbanDetail::class, 'id_qurban');
    }

    public function getTotalNominal()
    {
        return $this->detail()->sum('nominal');
    }
}
