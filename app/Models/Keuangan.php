<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 't_keuangan';
    protected $primaryKey = 'id_keuangan';
    protected $guarded = [];
}
