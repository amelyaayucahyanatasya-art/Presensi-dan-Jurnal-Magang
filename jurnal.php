<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jurnal - Presensi Magang</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="sidebar">
<h3>Presensi Magang</h3>
<a href="dashboard.php">Dashboard</a>
<a href="absensi.php">Absensi</a>
<a href="jurnal.php" class="active">Jurnal</a>
<a href="profil.php">Profil</a>
<a href="logout.php">Logout</a>
</div>
<div class="content">
<div class="card">
<h3>Jurnal Kegiatan Harian</h3>
<form id="formJurnal">
<input type="text" placeholder="Kegiatan Hari Ini" required>
<input type="text" placeholder="Kendala" required>
<input type="text" placeholder="Pembelajaran / Hasil" required>
<button type="submit">Simpan</button>
</form>
<table id="tabelJurnal">
<tr><th>No</th><th>Tanggal</th><th>Kegiatan</th><th>Kendala</th><th>Hasil</th></tr>
</table>
</div>
</div>
</body>
</html>