<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    use HasFactory;

    protected $table = 't_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_jamaah',
        'id_layanan',
        'tipe_pembayaran',
        'jumlah_pembayaran',
        'status_pembayaran',
        'tanggal_pembayaran',
        'foto_bukti_pembayaran',
    ];

    public function jamaah()
    {
        return $this->belongsTo(JamaahModel::class, 'id_jamaah', 'id_jamaah');
    }

    public function layanan()
    {
        return $this->belongsTo(LayananModel::class, 'id_layanan', 'id_layanan');
    }

    public function isTransactionFilled()
    {
        return $this->exists();
    }

    public function pesanVerifTransaksi($type, $tanggalUpdate, $tanggalApp, $id)
    {
        $Q_transaksi = DB::table('t_transaksi as a')
            ->join('t_jamaah as b', 'a.id_jamaah', '=', 'b.id_jamaah')
            ->join('t_layanan as c', 'a.id_layanan', '=', 'c.id_layanan')
            ->select('a.*', 'c.*', 'b.*')
            ->where('a.id_transaksi', '=', $id)
            ->first();

        $message = "*Whatsapp KBIH Wadi Fatimah*\n\n";

        if ($type == 'approved') {
            $message .= "Verifikasi transaksi _*BERHASIL*_, dengan data sebagai berikut:\n\n";
        } else {
            $message .= "Verifikasi transaksi _*DITOLAK/GAGAL*_, dengan data sebagai berikut:\n\n";
        }

        // Paragraf 1
        $message .= "Nama : *" . $Q_transaksi->nama_lengkap . "*\n";
        $message .= "Tgl Lahir : *" . $Q_transaksi->tempat_lahir . ", " . date('d-m-Y', strtotime($Q_transaksi->tgl_lahir)) . "*\n";
        $message .= "No Ktp : *" . $Q_transaksi->no_ktp . "*\n";
        $message .= "Umur : *" . $Q_transaksi->umur . " Tahun*\n";
        $message .= "Alamat : *" . $Q_transaksi->kecamatan . ", " . $Q_transaksi->kota_kabupaten . ", " . $Q_transaksi->provinsi . " " . $Q_transaksi->kode_pos . "*\n\n";

        // Paragraf 2
        $message .= "Adapun detail transaksi yang sudah anda lakukan sebagai berikut :\n\n";
        $message .= "Tgl Transaksi : *" . date('d-m-Y', strtotime($Q_transaksi->tanggal_pembayaran)) . "*\n";
        $message .= "Jumlah : *Rp " . number_format((float)$Q_transaksi->jumlah_pembayaran, 0, ',', '.') . "*\n";
        $message .= "Tipe Pembayaran : *" . strtoupper($Q_transaksi->tipe_pembayaran) . "*\n";
        $message .= "Status Pembayaran : *" . $Q_transaksi->status_pembayaran . "*\n\n";

        // Paragraf 3
        $message .= "Mohon untuk menyimpan pesan ini sebagai bukti transaksi yang berhasil. Kami juga ingin mengingatkan Anda untuk selalu waspada terhadap kemungkinan upaya penipuan yang menggunakan nama KBIH Wadi Fatimah. Keamanan informasi Anda adalah prioritas bagi kami.\n\n";

        if ($type == 'approved') {
            $message .= "\n_**Pesan ini dikirim secara otomatis pada $tanggalApp. Mohon tidak membalas pesan ini.*_";
        } else {
            $message .= "\nSilahkan kunjungi kantor KBIH Wadi Fatimah untuk informasi lebih lanjut.\n\n";
            $message .= "\n_**Pesan ini dikirim secara otomatis pada $tanggalApp. Mohon tidak membalas pesan ini.*_";
        }

        return $message;
    }


    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_transaksi = '222000' . random_int(10000, 99999);
            while (TransaksiModel::where('id_transaksi', $model->id_transaksi)->exists()) {
                $model->id_transaksi = '222000' . random_int(10000, 99999);
            }
        });
    }

    protected $keyType = 'int';
    protected $increment = 10;
}
