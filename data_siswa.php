<?php
session_start();
include '../config.php';

// Cek login admin
if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true){
    header("Location: ../index.php");
    exit();
}

// Hapus data siswa
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
    header("Location: data_siswa.php");
    exit();
}

// Ambil data siswa
$siswa = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Siswa</title>
<style>
body{
  font-family:'Poppins',sans-serif;
  margin:0;
  background:linear-gradient(135deg,#f8e8ff,#e0f7ff,#fef6d8);
}
table{
  width:95%;
  border-collapse:collapse;
  margin:20px auto;
  background:white;
  border-radius:10px;
  overflow:hidden;
}
th,td{
  border:1px solid #ddd;
  padding:10px;
  text-align:center;
}
th{
  background:#d8b4fe;
}
a.hapus{
  color:white;
  background:red;
  padding:6px 12px;
  border-radius:6px;
  text-decoration:none;
}
a.hapus:hover{background:darkred;}
.container{
  margin-left:270px;
  padding:20px;
}
</style>
</head>
<body>
<div class="container">
<h2>👨‍🎓 Data Siswa</h2>
<table>
<tr>
  <th>No</th>
  <th>Nama</th>
  <th>Email</th>
  <th>Asal Sekolah</th>
  <th>Jenis Kelamin</th>
  <th>Foto</th>
  <th>Aksi</th>
</tr>
<?php $no=1; while($row=mysqli_fetch_assoc($siswa)): ?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= htmlspecialchars($row['nama']) ?></td>
  <td><?= htmlspecialchars($row['email']) ?></td>
  <td><?= htmlspecialchars($row['asal_sekolah']) ?></td>
  <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
  <td><img src="../<?= $row['foto'] ?>" width="60"></td>
  <td><a href="?hapus=<?= $row['id'] ?>" class="hapus" onclick="return confirm('Hapus siswa ini?')">Hapus</a></td>
</tr>
<?php endwhile; ?>
</table>
</div>
</body>
</html>
