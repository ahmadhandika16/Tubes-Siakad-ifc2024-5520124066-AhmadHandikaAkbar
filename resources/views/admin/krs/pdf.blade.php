<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data KRS</title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 11px; color: #1e293b; }
        .header { text-align: center; margin-bottom: 16px; border-bottom: 2px solid #1d4ed8; padding-bottom: 10px; }
        .header h1 { font-size: 15px; margin: 0; color: #1d4ed8; }
        .header p { font-size: 10px; margin: 2px 0; color: #64748b; }
        .info-table { width: 100%; margin-bottom: 14px; }
        .info-table td { padding: 2px 0; font-size: 10px; }
        .info-table td.label { width: 120px; color: #64748b; }
        table.data { width: 100%; border-collapse: collapse; margin-top: 8px; }
        table.data th, table.data td { border: 1px solid #cbd5e1; padding: 5px 7px; font-size: 10px; }
        table.data th { background-color: #1d4ed8; color: white; text-align: left; }
        table.data tr:nth-child(even) { background-color: #f8fafc; }
        .total-row td { font-weight: bold; background-color: #eff6ff; }
        .footer { margin-top: 24px; font-size: 9px; color: #94a3b8; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>DATA KARTU RENCANA STUDI (KRS)</h1>
        <p>Sistem Informasi Akademik Sederhana</p>
    </div>

    @if($mahasiswaTunggal)
        <table class="info-table">
            <tr>
                <td class="label">Nama Mahasiswa</td>
                <td>: {{ $mahasiswaTunggal->nama }}</td>
            </tr>
            <tr>
                <td class="label">NPM</td>
                <td>: {{ $mahasiswaTunggal->npm }}</td>
            </tr>
            <tr>
                <td class="label">Dosen Wali</td>
                <td>: {{ $mahasiswaTunggal->dosen->nama ?? '-' }}</td>
            </tr>
        </table>
    @endif

    <table class="data">
        <thead>
            <tr>
                <th style="width: 24px;">No</th>
                @if(!$mahasiswaTunggal)
                    <th style="width: 75px;">NPM</th>
                    <th>Nama Mahasiswa</th>
                @endif
                <th style="width: 70px;">Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th style="width: 35px;">SKS</th>
                <th style="width: 90px;">Semester</th>
            </tr>
        </thead>
        <tbody>
            @forelse($krs as $i => $k)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    @if(!$mahasiswaTunggal)
                        <td>{{ $k->npm }}</td>
                        <td>{{ $k->mahasiswa->nama ?? '-' }}</td>
                    @endif
                    <td>{{ $k->kode_matakuliah }}</td>
                    <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $k->matakuliah->sks ?? 0 }}</td>
                    <td>{{ $k->semester }}</td>
                </tr>
            @empty
                <tr><td colspan="{{ $mahasiswaTunggal ? 5 : 7 }}" style="text-align:center;">Tidak ada data KRS.</td></tr>
            @endforelse
            @if($krs->isNotEmpty())
                <tr class="total-row">
                    <td colspan="{{ $mahasiswaTunggal ? 3 : 5 }}" style="text-align:right;">Total SKS</td>
                    <td>{{ $krs->sum(fn($k) => $k->matakuliah->sks ?? 0) }}</td>
                    <td></td>
                </tr>
            @endif
        </tbody>
    </table>

    <p class="footer">Dokumen ini dicetak otomatis oleh Sistem Informasi Akademik pada {{ now()->format('d F Y, H:i') }} WIB.</p>
</body>
</html>
