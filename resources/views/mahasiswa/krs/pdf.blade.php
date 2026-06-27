<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->nama }}</title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #1e293b; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #1d4ed8; padding-bottom: 12px; }
        .header h1 { font-size: 16px; margin: 0; color: #1d4ed8; }
        .header p { font-size: 11px; margin: 2px 0; color: #64748b; }
        .info-table { width: 100%; margin-bottom: 16px; }
        .info-table td { padding: 3px 0; font-size: 11px; }
        .info-table td.label { width: 130px; color: #64748b; }
        table.data { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data th, table.data td { border: 1px solid #cbd5e1; padding: 6px 8px; font-size: 11px; }
        table.data th { background-color: #1d4ed8; color: white; text-align: left; }
        table.data tr:nth-child(even) { background-color: #f8fafc; }
        .total-row td { font-weight: bold; background-color: #eff6ff; }
        .footer { margin-top: 30px; font-size: 10px; color: #94a3b8; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU RENCANA STUDI (KRS)</h1>
        <p>Sistem Informasi Akademik Sederhana</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama Mahasiswa</td>
            <td>: {{ $mahasiswa->nama }}</td>
        </tr>
        <tr>
            <td class="label">NPM</td>
            <td>: {{ $mahasiswa->npm }}</td>
        </tr>
        <tr>
            <td class="label">Dosen Wali</td>
            <td>: {{ $mahasiswa->dosen->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Semester</td>
            <td>: {{ $semester }}</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 90px;">Kode</th>
                <th>Nama Mata Kuliah</th>
                <th style="width: 50px;">SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($krs as $i => $k)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $k->kode_matakuliah }}</td>
                    <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $k->matakuliah->sks ?? 0 }}</td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align:center;">Belum ada mata kuliah yang diambil.</td></tr>
            @endforelse
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Total SKS</td>
                <td>{{ $totalSks }}</td>
            </tr>
        </tbody>
    </table>

    <p class="footer">Dokumen ini dicetak otomatis oleh Sistem Informasi Akademik pada {{ now()->format('d F Y, H:i') }} WIB.</p>
</body>
</html>
