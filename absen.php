<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Absensi - Presensi Magang</title>
<link rel="stylesheet" href="style.css">
<script src="script.js" defer></script>
</head>
<body>
<div class="sidebar">
<h3>Presensi Magang</h3>
<a href="dashboard.php">Dashboard</a>
<a href="absensi.php" class="active">Absensi</a>
<a href="jurnal.php">Jurnal</a>
<a href="profil.php">Profil</a>
<a href="logout.php">Logout</a>
</div>
<div class="content">
<div class="card">
<h3>Absensi Harian</h3>
<button class="btn-absen" onclick="absenMasuk()">Absen Masuk</button>
<button class="btn-absen" onclick="absenPulang()">Absen Pulang</button>
<table id="tabelAbsensi">
<tr><th>No</th><th>Tanggal</th><th>Jam Masuk</th><th>Jam Pulang</th><th>Status</th></tr>
</table>
</div>
</div>
</body>
</html>