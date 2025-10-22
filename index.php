<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Presensi Magang</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
<h2>Login Siswa Magang</h2>
<form action="dashboard.php" method="POST">
<input type="text" name="nama" placeholder="Nama Lengkap" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<input type="text" name="asal_sekolah" placeholder="Asal Sekolah" required>
<select name="jenis_kelamin" required>
<option value="">Pilih Jenis Kelamin</option>
<option value="L">Laki-laki</option>
<option value="P">Perempuan</option>
</select>
<button type="submit">Masuk</button>
</form>
</div>
</body>
</html>