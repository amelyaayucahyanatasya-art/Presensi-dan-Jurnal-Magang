<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$_SESSION['nama'] = $_POST['nama'];
}
$nama = $_SESSION['nama'] ?? 'Siswa';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Presensi Magang</title>
<link rel="stylesheet" href="style.css">
<script src="script.js" defer></script>
</head>
<body>
<div class="sidebar">
<h3>Presensi Magang</h3>
<a href="dashboard.php" class="active">Dashboard</a>
<a href="absensi.php">Absensi</a>
<a href="jurnal.php">Jurnal</a>
<a href="profil.php">Profil</a>
<a href="logout.php">Logout</a>
</div>
<div class="content">
<div class="card">
<h2>Selamat Datang, <?php echo htmlspecialchars($nama); ?>!</h2>
<p>Ringkasan hari ini:</p>
<ul>
<li>Absensi: Belum Absen</li>
<li>Jurnal: Belum Diisi</li>
</ul>
<div id="jam"></div>
</div>
</div>
</body>
</html>