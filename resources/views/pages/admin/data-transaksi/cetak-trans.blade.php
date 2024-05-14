<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Hasil KPI</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style>
    body {
        margin: 89px 15px 15px 15px;
        padding: 0;
    }

    .tabel-content,
    .tabel-hasil,
    .content-value {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 1px 2px;
    }

    .content-value-center {
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
        padding: 1px 2px;
    }

    .td-atas {
        margin-right: 50px;
        text-align: right;
        color: rgb(54, 54, 233);
        font-style: italic;
    }

    .header-content {
        text-align: center;
        margin-bottom: 20px;
    }

    .logo {
        width: 180px;
        align-content: left;
    }

    .logo-kpi {
        width: 180px;
        align-content: right;
    }

    .tabel-data {
        border: 0px;
        border-collapse: collapse;
    }

    .header-content {
        text-align: center;
        margin-bottom: 20px;
    }

    .page-break {
        page-break-after: always;
    }

    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 3cm;
        text-align: left;
        margin-bottom: 1.2cm;
    }

    .td-atas {
        margin-right: 50px;
        text-align: right;
        color: rgb(54, 54, 233);
        font-style: italic;
    }

    thead {
        background-color: #a8c8ff;
    }

    .colspan {
        background-color: #cbcbcb;
    }

    hr {
        border: none;
        height: 2px;
        color: #333;
        background-color: #333;
    }

    .hr {
        border: none;
        height: 3px;
        color: #333;
        background-color: #333;
    }

    .garis-vertical {
        border-left: 3px solid #333;
        height: 50px;
    }
</style>

<body style="font-family: times ">
    <header>
        <table width="100%">
            <tr> </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <th></th>
            <tr>
                <td style="width: 190px">
                    <img class="logo"
                        src="https://static.vecteezy.com/system/resources/previews/007/920/243/original/mecca-kaaba-logo-illustration-design-template-inspiration-kaaba-logo-flat-design-vector.jpg">

                </td>
                {{-- <td style="width: 14px">
                    <div class="garis-vertical"></div>
                </td>
                @foreach ($header as $item)
                    <td style="font-size: 10pt; width: 390px">
                        <strong>{{ $item->n_kan }}</strong>
                        <br>
                        {{ $item->alamat_kantor }}
                    </td>
                @endforeach --}}
                <td class="td-atas">
                    <div class="tebal" style="font-size: 19px;">INVOICE</div>
                </td>
            </tr>
        </table>
        <hr>
    </header>


</body>

</html>
