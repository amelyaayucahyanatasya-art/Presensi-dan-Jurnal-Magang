<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sidebar Menu</title>
<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background: #f8fafc;
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

/* Menu Items */
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

/* Ikon */
.sidebar ul li a span {
  font-size: 20px;
}
</style>
</head>
<body>
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


</body>
</html>
