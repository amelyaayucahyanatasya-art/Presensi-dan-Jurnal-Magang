<?php
session_start();
include '../config.php';

if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true){
    header("Location: ../index.php");
    exit();
}

$absensi = mysqli_query($conn, "
  SELECT a.*, u.nama 
  FROM absensi a 
  JOIN users u ON a.user_id = u.id 
  ORDER BY a.tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Absensi</title>
<style>
body{
  font-family:'Poppins',sans-serif;
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
  background:#a5b4fc;
}
.status{
  padding:4px 8px;
  border-radius:6px;
  color:white;
}
.status.hijau{background:green;}
.status.merah{background:red;}
.container{
  margin-left:270px;
  padding:20px;
}
</style>
</head>
<body>
<div class="container">
<h2>🕒 Data Absensi</h2>
<table>
<tr>
  <th>No</th>
  <th>Nama</th>
  <th>Tanggal</th>
  <th>Jam Masuk</th>
  <th>Jam Pulang</th>
  <th>Status</th>
</tr>
<?php $no=1; while($row=mysqli_fetch_assoc($absensi)): ?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= htmlspecialchars($row['nama']) ?></td>
  <td><?= $row['tanggal'] ?></td>
  <td><?= $row['jam_masuk'] ?></td>
  <td><?= $row['jam_pulang'] ?></td>
  <td>
    <span class="status <?= ($row['status']=='Tepat Waktu')?'hijau':'merah' ?>">
      <?= $row['status'] ?>
    </span>
  </td>
</tr>
<?php endwhile; ?>
</table>
</div>
</body>
</html>
