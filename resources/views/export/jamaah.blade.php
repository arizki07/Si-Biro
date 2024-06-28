<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Data Arsip Jamaah</title>
    <style>
        .header,
        .td-atas {
            text-align: center;
        }

        .data-table,
        .table-bawah,
        table {
            border-collapse: collapse;
        }

        .data-label,
        .td-bawah,
        .tebal {
            font-weight: 700;
        }

        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
        }

        table td,
        table th {
            padding: 4px;
            border: 1px solid #000;
        }

        table th {
            background-color: #edfff0;
        }

        .rangkasurat {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
        }

        .logo {
            width: 100px;
        }

        .header {
            margin-top: 15px;
        }

        .header h1,
        .header h2 {
            margin: 0;
            padding: 0;
        }

        .additional-info,
        .header-content {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-container {
            margin-top: 20px;
        }

        .table-bawah {
            border: 0;
            font-size: 12pt;
            width: 100%;
            margin: auto;
        }

        .border-solid,
        .td-bawah {
            border: 1px solid #000;
        }

        .table-bawah td {
            border: 0;
            padding: 8px;
            text-align: left;
        }

        .td-bawah-second,
        .td-bawah-third {
            border: 1px solid #000;
            padding: 8px;
        }

        .td-bawah {
            padding: 8px;
        }

        .td-atas {
            margin-right: 50px;
        }

        .garis {
            border: 2px solid #000;
        }

        .kontak {
            font-size: 10px;
        }

        .nomor-halaman,
        .nomor-surat,
        .tgl {
            font-size: 12px;
        }

        .nomor-surat {
            float: left;
        }

        .tgl {
            float: right;
        }

        .nomor-halaman {
            text-align: right;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .keterangan-kiri {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 12px;
        }

        .data-table {
            width: 100%;
            margin: 20px auto;
            text-align: center;
            font-size: 9pt;
        }

        .data-label,
        .data-value,
        .data-value-1 {
            text-align: left;
        }

        .data-value-right {
            text-align: right;
        }

        .data-value-center {
            text-align: center;
        }

        .signatures-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .additional-info label {
            display: block;
        }

        .underline {
            text-decoration: underline;
        }

        /* New CSS for the transactions table */
        .transactions-table {
            width: 100%;
            margin: 20px auto;
            text-align: center;
            font-size: 12pt;
        }

        .transactions-table td,
        .transactions-table th {
            padding: 6px;
            border: 1px solid #000;
        }

        .transactions-table th {
            background-color: #fff5e6;
        }
    </style>
</head>

<body>
    <?php
    // Set zona waktu sesuai dengan waktu yang diinginkan
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <div class="rangkasurat">
        <div class="header">
            <table width="100%">
                <tr>
                    <td class="td-atas" style="border-top: 0; border-right: 0; border-bottom: 0; border-left: 0;">
                        <div class="tebal" style="font-size: 22px;">LAPORAN DATA ARSIP JAMAAH WADIFATIMAH</div>
                        <div class="tebal">
                            <font style="font-size: 14px;">Hasil export PDF dilakukan secara otomatis oleh sistem
                            </font>
                        </div>
                    </td>
                </tr>
            </table>
            <hr class="garis">
        </div>
        <h5>Tanggal Cetak Laporan : <?= date('d-m-Y H:i:s') ?> WIB</h5>

        <h2>Data Jamaah</h2>
        <table class="data-table">
            <thead>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">Nama</th>
                    <th scope="col">JK</th>
                    <th scope="col">Tgl Lahir</th>
                    <th scope="col">Rekening</th>
                    <th scope="col">KTP</th>
                    <th scope="col">Haji/Umroh</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Alamat Lengkap</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jamaah as $key => $item)
                    <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->jk }}</td>
                        <td>{{ $item->tgl_lahir }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->no_ktp }}</td>
                        <td>{{ $item->pernah_haji_umroh }}</td>
                        <td>{{ $item->kota_kabupaten }}</td>
                        <td>{{ $item->alamat_lengkap }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Data Transaksi</h2>
        <table class="transactions-table">
            <thead>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Layanan</th>
                    <th scope="col">Tipe Pembayaran</th>
                    <th scope="col">Jumlah Pembayaran</th>
                    <th scope="col">Status Pembayaran</th>
                    <th scope="col">Tanggal Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $key => $tr)
                    <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $tr->jamaah->nama_lengkap }}</td>
                        <td>LA-{{ $tr->id_layanan }}</td>
                        <td>{{ $tr->tipe_pembayaran }}</td>
                        <td>{{ $tr->jumlah_pembayaran }}</td>
                        <td>{{ $tr->status_pembayaran }}</td>
                        <td>{{ $tr->tanggal_pembayaran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        window.onbeforeprint = function() {
            document.getElementById('elementId').style.display =
                document.getElementById('header').style.display = 'none';
        };

        window.onafterprint = function() {
            document.getElementById('elementId').style.display =
                'block';
            document.getElementById('header').style.display =
                'block';
        };

        window.onload = function() {};
    </script>

</body>

</html>
