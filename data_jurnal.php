<?php
session_start();
include '../config.php';

if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true){
    header("Location: ../index.php");
    exit();
}

$jurnal = mysqli_query($conn, "
  SELECT j.*, u.nama 
  FROM jurnal j 
  JOIN users u ON j.user_id = u.id 
  ORDER BY j.tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Jurnal</title>
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
}
th,td{
  border:1px solid #ddd;
  padding:10px;
  text-align:center;
}
th{background:#c4b5fd;}
.container{
  margin-left:270px;
  padding:20px;
}
</style>
</head>
<body>
<div class="container">
<h2>📘 Data Jurnal</h2>
<table>
<tr>
  <th>No</th>
  <th>Nama</th>
  <th>Tanggal</th>
  <th>Kegiatan</th>
  <th>Kendala</th>
  <th>Pembelajaran</th>
</tr>
<?php $no=1; while($row=mysqli_fetch_assoc($jurnal)): ?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= htmlspecialchars($row['nama']) ?></td>
  <td><?= $row['tanggal'] ?></td>
  <td><?= htmlspecialchars($row['kegiatan']) ?></td>
  <td><?= htmlspecialchars($row['kendala']) ?></td>
  <td><?= htmlspecialchars($row['pembelajaran']) ?></td>
</tr>
<?php endwhile; ?>
</table>
</div>
</body>
</html>
