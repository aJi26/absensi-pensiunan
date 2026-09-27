<!DOCTYPE html>
<html>
<head>
    <title>Rekap Data Presensi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #0f172a; color: white; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PT JASAMARGA</h2>
        <h3>Rekap Data Presensi Karyawan / Ahli Waris</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPP</th>
                <th>Nama</th>
                <th>Tanggal Pengisian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekaps as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->karyawan->npp }}</td>
                <td>{{ $item->karyawan->nama }}</td>
                <td>{{ $item->tanggal_pengisian->format('d/m/Y H:i') }} WIB</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>