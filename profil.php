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
<title>Profil</title>
<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #f8e8ff, #e0f7ff, #fef6d8);
}
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
}
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
.sidebar.hidden { left: -260px; }
.sidebar h2 { text-align: center; color: #3f3f46; }
.sidebar ul { list-style: none; padding: 0; }
.sidebar ul li { margin: 10px 0; }
.sidebar ul li a {
  display: flex; align-items: center; gap: 10px;
  color: #3f3f46; text-decoration: none; padding: 10px 20px;
  border-radius: 10px; transition: 0.3s;
}
.sidebar ul li a:hover, .sidebar ul li a.active { background: rgba(255,255,255,0.6); }

.content { margin-left: 270px; padding: 30px; transition: margin-left 0.3s; text-align: center; }
.sidebar.hidden ~ .content { margin-left: 50px; }
.profile-card {
  background: white;
  border-radius: 20px;
  padding: 30px;
  width: 320px;
  margin: 50px auto;
  box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}
.profile-card img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 15px;
  border: 4px solid #c084fc;
}
</style>
</head>
<body>

<div class="menu-toggle" onclick="toggleSidebar()">☰</div>

<div class="sidebar" id="sidebar">
  <h2>📋 Menu</h2>
  <ul>
    <li><a href="dashboard.php"><span>🏠</span> Dashboard</a></li>
    <li><a href="absensi.php"><span>🕒</span> Absensi</a></li>
    <li><a href="jurnal.php"><span>📘</span> Jurnal</a></li>
    <li><a href="profil.php" class="active"><span>👤</span> Profil</a></li>
    <li><a href="logout.php"><span>🚪</span> Logout</a></li>
  </ul>
</div>

<div class="content">
  <h1>👤 Profil Kamu</h1>
  <div class="profile-card">
    <img src="<?php echo $_SESSION['foto'] ?? 'default.jpg'; ?>" alt="Foto Profil">
    <h2><?php echo $_SESSION['nama']; ?></h2>
    <p>Email: <?php echo $_SESSION['email'] ?? '-'; ?></p>
  </div>
</div>

<script>
function toggleSidebar() {
  document.getElementById('sidebar').classList.toggle('hidden');
}
</script>

</body>
</html>
