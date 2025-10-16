<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengujiAktivitasModel extends Model
{
    protected $table = 'tr_penguji_aktivitas';

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
}
