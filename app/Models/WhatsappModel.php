<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappModel extends Model
{
    use HasFactory;
    protected $table = 'log_app';
    protected $fillable = [
        'action',
        'id_jamaah',
        'ip',
        'json',
        'status',
    ];
}
