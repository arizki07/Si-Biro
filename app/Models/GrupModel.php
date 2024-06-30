<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GrupModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_grup';
    protected $table = 't_grup';
    protected $fillable = [
        'id_jamaah',
        'id_layanan',
        'kode_grup',
        'no_hp',
    ];

    public function jamaah(): BelongsTo
    {
        return $this->belongsTo(JamaahModel::class, 'id_jamaah');
    }
}
