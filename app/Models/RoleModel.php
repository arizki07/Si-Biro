<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    protected $table = 't_role';
    protected $primaryKey = 'id_role';
    protected $fillable = [
        'role',
    ];
}
