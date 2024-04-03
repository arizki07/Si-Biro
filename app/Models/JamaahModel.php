<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamaahModel extends Model
{
    use HasFactory;

    protected $table = 't_jamaah';
    protected $primaryKey = 'id_jamaah';
    protected $fillable = [
        'id_user',
        'id_role',
        'id_layanan',
        'nama_lengkap',
        'umur',
        'jk',
        'status',
        'tempat_lahir',
        'tgl_lahir',
        'no_hp',
        'no_hp_wali',
        'no_rekening',
        'no_ktp',
        'no_kk',
        'no_passport',
        'bank',
        'berat_badan',
        'tinggi_badan',
        'warna_kulit',
        'pekerjaan',
        'pendidikan',
        'pernah_haji_umroh',
        'kelurahan',
        'kecamatan',
        'kota_kabupaten',
        'provinsi',
        'kode_pos',
        'alamat_lengkap',
        'warga_negara',
        'gol_darah',
        'foto_ktp',
        'foto_kk',
        'foto_passport',
        'pas_foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'id_role', 'id_role');
    }

    public function layanan()
    {
        return $this->belongsTo(LayananModel::class, 'id_layanan', 'id_layanan');
    }
}
