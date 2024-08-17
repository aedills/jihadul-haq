<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdminn extends Model
{
    use HasFactory;
    protected $table = 'data_user';
    protected $primary_key = 'id';
    protected $fillable = [
        'nama', 'username', 'p4ssw0rd', 'role'
    ];

    protected $hidden = [
        'p4ssw0rd',
    ];
}
