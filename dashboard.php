<?php
session_start();
if(!isset($_SESSION['nama'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #f8e8ff, #e0f7ff, #fef6d8);
}

/* Tombol Toggle (☰) */
.menu-toggle {
  position: fixed;
  top: 15px;
  left: 15px;
  background: white;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  cursor: pointer;
  z-index: 1100;
  font-size: 24px;
  color: #6b21a8;
  transition: 0.3s;
}
.menu-toggle:hover {
  background: #f3e8ff;
}

/* Sidebar */
.sidebar {
  width: 250px;
  height: 100vh;
  background: linear-gradient(180deg, #d8b4fe, #e0e7ff, #f5d0fe);
  padding-top: 20px;
  border-top-right-radius: 20px;
  border-bottom-right-radius: 20px;
  box-shadow: 2px 0 10px rgba(0,0,0,0.1);
  position: fixed;
  left: 0;
  top: 0;
  transition: left 0.3s ease;
}
.sidebar.hidden {
  left: -260px;
}

/* Header */
.sidebar h2 {
  color: #3f3f46;
  font-size: 22px;
  text-align: center;
  font-weight: 600;
  margin-bottom: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Menu */
.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.sidebar ul li {
  margin: 10px 0;
}
.sidebar ul li a {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #3f3f46;
  text-decoration: none;
  padding: 10px 20px;
  border-radius: 10px;
  transition: 0.3s;
}
.sidebar ul li a:hover, .sidebar ul li a.active {
  background: rgba(255,255,255,0.6);
}
.sidebar ul li a span {
  font-size: 20px;
}

/* Content */
.content {
  margin-left: 270px;
  padding: 30px;
  text-align: center;
  transition: margin-left 0.3s ease;
}
.sidebar.hidden ~ .content {
  margin-left: 50px;
}

.content h1 {
  color: #4c1d95;
}

.greeting {
  margin-top: 15px;
  font-size: 18px;
  color: #6b21a8;
}
</style>
</head>
<body>

<!-- Tombol Toggle -->
<div class="menu-toggle" onclick="toggleSidebar()">☰</div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <h2>📋 Menu</h2>
  <ul>
    <li><a href="dashboard.php" class="active"><span>🏠</span> Dashboard</a></li>
    <li><a href="absensi.php"><span>🕒</span> Absensi</a></li>
    <li><a href="jurnal.php"><span>📘</span> Jurnal</a></li>
    <li><a href="profil.php"><span>👤</span> Profil</a></li>
    <li><a href="logout.php"><span>🚪</span> Logout</a></li>
  </ul>
</div>

<!-- Konten -->
<div class="content" id="content">
  <h1>Halo, <?php echo strtoupper($_SESSION['nama']); ?> 👋</h1>
  <p class="greeting">Selamat belajar kembali! Semoga harimu penuh semangat dan ilmu yang bermanfaat.<br> Tetap fokus dan jangan mudah menyerah! 💪📚✨</p>
</div>

<!-- Script -->
<script>
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('hidden');
}
</script>

</body>
</html>
