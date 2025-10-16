<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonversiMKModel extends Model
{
    protected $table = 'tr_konversi_mk';

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
}
