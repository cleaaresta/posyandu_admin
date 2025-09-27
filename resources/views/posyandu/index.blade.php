<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #1560b2 0%, #f4f8fb 100%);
        min-height: 100vh;
    }
    .navbar {
        background: #1a4e8a;
        padding: 0;
        margin-bottom: 32px;
        box-shadow: 0 2px 8px #0001;
    }
    .navbar ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .navbar li {
        flex: 1;
        text-align: center;
        padding: 18px 0;
        color: #fff;
        font-weight: bold;
        font-size: 1.1em;
        border-right: 1px solid #fff3;
        cursor: pointer;
        transition: background 0.2s;
    }
    .navbar li:last-child { border-right: none; }
    .navbar li.active, .navbar li:hover { background: #1560b2; }
    .container { max-width: 900px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
    h1 { color: #1a4e8a; text-align: center; margin-bottom: 24px; }
    table { width: 100%; border-collapse: collapse; background: #f7fafc; }
    th, td { padding: 12px; border: 1px solid #e3e3e3; text-align: center; }
    th { background: #eaf2fb; color: #1a4e8a; }
 
</style>

<div class="navbar">
    <ul>
        <li class="active">Halaman Utama</li>
        <li>Konsultasi Kesehatan</li>
        <li>Kalkulator Kesehatan</li>
        <li>Direktori Kesehatan</li>
    </ul>
</div>

<div class="container">
    <h1>Daftar Posyandu</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>RT</th>
                <th>RW</th>
                <th>Kontak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posyandu as $item)
            <tr>
                <td>{{ $item['posyandu_id'] }}</td>
                <td>{{ $item['nama'] }}</td>
                <td>{{ $item['alamat'] }}</td>
                <td>{{ $item['rt'] }}</td>
                <td>{{ $item['rw'] }}</td>
                <td>{{ $item['kontak'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>