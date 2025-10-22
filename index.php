<?php
session_start();

// 🔒 Cek apakah admin sudah login
if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true){
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>
<style>
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  background: linear-gradient(135deg, #f8e8ff, #e0f7ff, #fef6d8);
}

/* Sidebar Admin */
.sidebar {
  width: 250px;
  height: 100vh;
  background: linear-gradient(180deg, #c4b5fd, #e9d5ff, #d8b4fe);
  padding-top: 20px;
  position: fixed;
  left: 0;
  top: 0;
  box-shadow: 2px 0 8px rgba(0,0,0,0.1);
}

.sidebar h2 {
  color: #3f3f46;
  text-align: center;
  margin-bottom: 25px;
}

.sidebar ul {
  list-style: none;
  padding: 0;
}

.sidebar ul li {
  margin: 10px 0;
}

.sidebar ul li a {
  display: block;
  color: #3f3f46;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 10px;
  transition: 0.3s;
}

.sidebar ul li a:hover,
.sidebar ul li a.active {
  background: rgba(255, 255, 255, 0.6);
}

/* Content */
.content {
  margin-left: 270px;
  padding: 30px;
}

h1 {
  color: #4c1d95;
}
</style>
</head>
<body>

<div class="sidebar">
  <h2>Admin Menu</h2>
  <ul>
    <li><a href="admin_dashboard.php" class="active">🏠 Dashboard</a></li>
    <li><a href="data_siswa.php">👨‍🎓 Data Siswa</a></li>
    <li><a href="data_absensi.php">🕒 Data Absensi</a></li>
    <li><a href="data_jurnal.php">📘 Data Jurnal</a></li>
    <li><a href="../logout.php">🚪 Logout</a></li>
  </ul>
</div>

<div class="content">
  <h1>Selamat Datang, Administrator 👋</h1>
  <p>Anda masuk sebagai admin sistem presensi magang.<br>Gunakan menu di kiri untuk mengelola data siswa, absensi, dan jurnal.</p>
</div>

</body>
</html>
