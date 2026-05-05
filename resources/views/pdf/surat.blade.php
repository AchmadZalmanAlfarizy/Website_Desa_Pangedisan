<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $surat->no_surat }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #000;
            line-height: 1.5;
        }
        .kop {
            border-bottom: 4px double #000;
            padding-bottom: 8px;
            margin-bottom: 18px;
            text-align: center;
        }
        .kop-table { width: 100%; }
        .kop-logo { width: 80px; text-align: center; }
        .kop-logo img { width: 70px; height: 70px; }
        .kop-teks h2 { font-size: 15pt; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .kop-teks h3 { font-size: 13pt; font-weight: bold; text-transform: uppercase; }
        .kop-teks p { font-size: 10pt; margin-top: 2px; }

        .judul-surat {
            text-align: center;
            margin: 20px 0 16px;
        }
        .judul-surat h3 {
            font-size: 13pt;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: underline;
            letter-spacing: 1px;
        }
        .judul-surat p { font-size: 10pt; margin-top: 4px; }

        .isi-surat { margin: 0 20px 20px; }
        .isi-surat p { margin-bottom: 8px; text-align: justify; }

        table.data-diri { width: 100%; border-collapse: collapse; margin: 10px 0 16px; }
        table.data-diri td { padding: 3px 6px; font-size: 11pt; vertical-align: top; }
        table.data-diri td:first-child { width: 38%; }
        table.data-diri td:nth-child(2) { width: 4%; text-align: center; }

        .ttd-section {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }
        .ttd-box { text-align: center; width: 260px; }
        .ttd-box .ttd-space { height: 70px; }
        .ttd-box .nama { font-weight: bold; text-decoration: underline; }
        .ttd-box .nip { font-size: 10pt; }

        .catatan { margin-top: 20px; font-size: 10pt; color: #444; font-style: italic; }
    </style>
</head>
<body>
    {{-- KOP SURAT --}}
    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                <img src="{{ public_path('images/logo-desa.png') }}" alt="Logo" onerror="this.style.display='none'">
            </td>
            <td class="kop-teks">
                <h2>Pemerintah Desa Pagendisan</h2>
                <h3>Kecamatan Winong, Kabupaten Pati</h3>
                <p>Jl. Raya Pagendisan No. 1, Desa Pagendisan, Kec. Winong, Kab. Pati, Prov. Jawa Tengah</p>
                <p>Kode Pos: 59182 | Telepon: (0295) XXXXXX</p>
            </td>
        </tr>
    </table>
    <div style="border-bottom:4px double #000;margin-bottom:18px;"></div>

    {{-- JUDUL SURAT --}}
    <div class="judul-surat">
        <h3>{{ $surat->jenisSurat->nama }}</h3>
        <p>Nomor: {{ $surat->no_surat }}</p>
    </div>

    {{-- ISI SURAT --}}
    <div class="isi-surat">
        <p>Yang bertanda tangan di bawah ini, Kepala Desa Pagendisan, Kecamatan Winong, Kabupaten Pati, dengan ini menerangkan bahwa:</p>

        @if($surat->penduduk)
        <table class="data-diri">
            <tr><td>Nama Lengkap</td><td>:</td><td><strong>{{ $surat->penduduk->nama_lengkap }}</strong></td></tr>
            <tr><td>NIK</td><td>:</td><td>{{ $surat->penduduk->nik }}</td></tr>
            <tr><td>Tempat, Tgl. Lahir</td><td>:</td><td>{{ $surat->penduduk->tempat_lahir }}, {{ $surat->penduduk->tanggal_lahir->translatedFormat('d F Y') }}</td></tr>
            <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->penduduk->jenis_kelamin }}</td></tr>
            <tr><td>Agama</td><td>:</td><td>{{ $surat->penduduk->agama }}</td></tr>
            <tr><td>Status Perkawinan</td><td>:</td><td>{{ $surat->penduduk->status_perkawinan }}</td></tr>
            <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->penduduk->pekerjaan ?? '-' }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $surat->penduduk->alamat }}, RT {{ $surat->penduduk->rt }}/RW {{ $surat->penduduk->rw }}, Desa Pagendisan, Kec. Winong, Kab. Pati</td></tr>
        </table>
        @endif

        @if($surat->isi_surat)
        <p>{{ $surat->isi_surat }}</p>
        @else
        <p>Bahwa orang tersebut di atas adalah benar merupakan warga Desa Pagendisan, Kecamatan Winong, Kabupaten Pati, yang diketahui berkelakuan baik dan tertib hukum.</p>
        @endif

        <p>Surat keterangan ini dibuat untuk keperluan: <strong>{{ $surat->keperluan }}</strong>, dan dapat dipergunakan sebagaimana mestinya.</p>

        <p>Demikian surat keterangan ini dibuat dengan sebenar-benarnya agar dapat digunakan sebagaimana mestinya.</p>
    </div>

    {{-- TANDA TANGAN --}}
    <table style="width:100%;">
        <tr>
            <td style="width:55%;"></td>
            <td style="text-align:center;">
                <p>Pagendisan, {{ $surat->tanggal_surat->translatedFormat('d F Y') }}</p>
                <p><strong>Kepala Desa Pagendisan</strong></p>
                <br><br><br>
                <p style="font-weight:bold;text-decoration:underline;">
                    {{ $surat->ttd_kepala_desa ?? '(..............................)' }}
                </p>
            </td>
        </tr>
    </table>

    <p class="catatan">* Surat ini diterbitkan secara elektronik melalui Sistem Administrasi Desa Pagendisan. No: {{ $surat->no_surat }}</p>
</body>
</html>
