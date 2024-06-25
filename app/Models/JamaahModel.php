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
        'status',
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

    public function transaksi()
    {
        return $this->hasMany(TransaksiModel::class, 'id_jamaah', 'id_jamaah');
    }

    public function pesanVerifBiodata($type, $tanggalUpdate, $tanggalApp)
    {
        $message = "*Whatsapp KBIH Wadi Fatimah*\n\n";

        if ($type == 'approved') {
            $message .= "Verifikasi biodata _*BERHASIL*_, dengan data sebagai berikut:\n\n";
        } else {
            $message .= "Verifikasi biodata _*DITOLAK/GAGAL*_, dengan data sebagai berikut:\n\n";
        }

        $message .= "Nama : *" . $this->nama_lengkap . "*\n";
        $message .= "Tgl Lahir : *" . $this->tempat_lahir . ", " . date('d-m-Y', strtotime($this->tgl_lahir)) . "*\n";
        $message .= "No Ktp : *" . $this->no_ktp . "*\n";
        $message .= "Umur : *" . $this->umur . " Tahun*\n";
        $message .= "Alamat : *" . $this->kecamatan . ", " . $this->kota_kabupaten . ", " . $this->provinsi . " " . $this->kode_pos . "*\n";
        
        if ($type == 'approved') {
            $message .= "\n_**Pesan ini dikirim secara otomatis pada $tanggalApp. Mohon tidak membalas pesan ini.*_";
        } else {
            $message .= "\nSilahkan kunjungi kantor KBIH Wadi Fatimah untuk informasi lebih lanjut.\n\n";
            $message .= "\n_**Pesan ini dikirim secara otomatis pada $tanggalApp. Mohon tidak membalas pesan ini.*_";
        }

        return $message;
    }
}
