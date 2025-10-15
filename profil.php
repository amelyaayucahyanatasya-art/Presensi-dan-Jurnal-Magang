<?php
// Buat file profil.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="sidebar">
<ul>
<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="absensi.php">Absensi</a></li>
<li><a href="jurnal.php">Jurnal</a></li>
<li><a href="profil.php" class="active">Profil</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>


<div class="content">
<h2>Profil Siswa</h2>
<p><strong>Nama:</strong> <?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Nama Siswa'; ?></p>
<p><strong>Email:</strong> <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'Email Siswa'; ?></p>
<p><strong>Asal Sekolah:</strong> <?php echo isset($_SESSION['asal_sekolah']) ? $_SESSION['asal_sekolah'] : 'Sekolah'; ?></p>
</div>
</body>
</html>