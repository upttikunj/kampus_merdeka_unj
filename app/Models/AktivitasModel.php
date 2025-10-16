<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasModel extends Model
{
    protected $table = 'tr_aktivitas';

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

}
