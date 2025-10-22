<?php
session_start();
include 'config.php';
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

date_default_timezone_set("Asia/Jakarta");
$user_id = $_SESSION['user_id'];
$tanggal = date("Y-m-d");

// Simpan data jurnal baru
if(isset($_POST['simpan'])){
    $kegiatan = mysqli_real_escape_string($conn, $_POST['kegiatan']);
    $kendala = mysqli_real_escape_string($conn, $_POST['kendala']);
    $pembelajaran = mysqli_real_escape_string($conn, $_POST['pembelajaran']);
    mysqli_query($conn, "INSERT INTO jurnal (user_id, tanggal, kegiatan, kendala, pembelajaran) 
                         VALUES ('$user_id', '$tanggal', '$kegiatan', '$kendala', '$pembelajaran')");
    header("Location: jurnal.php");
    exit();
}

// Update jurnal
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $kegiatan = mysqli_real_escape_string($conn, $_POST['kegiatan']);
    $kendala = mysqli_real_escape_string($conn, $_POST['kendala']);
    $pembelajaran = mysqli_real_escape_string($conn, $_POST['pembelajaran']);
    mysqli_query($conn, "UPDATE jurnal SET kegiatan='$kegiatan', kendala='$kendala', pembelajaran='$pembelajaran' WHERE id='$id' AND user_id='$user_id'");
    header("Location: jurnal.php");
    exit();
}

// Hapus jurnal
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM jurnal WHERE id='$id' AND user_id='$user_id'");
    header("Location: jurnal.php");
    exit();
}

// Ambil data untuk edit
$editData = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $editData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jurnal WHERE id='$id' AND user_id='$user_id'"));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jurnal Kegiatan</title>
<style>
body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #f8e8ff, #e0f7ff, #fef6d8);
}

/* Tombol ☰ */
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
.sidebar.hidden { left: -260px; }

.sidebar h2 {
  color: #3f3f46;
  font-size: 22px;
  text-align: center;
  font-weight: 600;
  margin-bottom: 25px;
}

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

/* Konten */
.content {
  margin-left: 270px;
  padding: 40px;
  transition: margin-left 0.3s;
}
.sidebar.hidden ~ .content { margin-left: 60px; }

h1 {
  color: #4c1d95;
  text-align: center;
}

/* Form */
form {
  background: white;
  padding: 25px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  width: 80%;
  margin: 20px auto;
}
form h3 { margin-bottom: 10px; color: #4c1d95; }
textarea {
  width: 100%;
  height: 80px;
  border: 1px solid #ccc;
  border-radius: 10px;
  padding: 10px;
  font-size: 15px;
  resize: none;
  background: #f9f9f9;
  margin-bottom: 15px;
}
button {
  background: linear-gradient(135deg,#93c5fd,#a5b4fc);
  border: none;
  padding: 10px 25px;
  border-radius: 10px;
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
  margin-right: 10px;
}
button:hover { opacity: 0.9; }

/* Tabel */
table {
  width: 95%;
  margin: 30px auto;
  border-collapse: collapse;
  background: white;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
th, td {
  padding: 12px;
  text-align: center;
}
th {
  background: #d8b4fe;
  color: #3f3f46;
}
tr:nth-child(even) {
  background: #f3e8ff;
}
a.btn {
  padding: 5px 10px;
  border-radius: 8px;
  text-decoration: none;
  color: white;
}
a.edit { background: #34d399; }
a.hapus { background: #f87171; }
</style>
</head>
<body>

<div class="menu-toggle" onclick="toggleSidebar()">☰</div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <h2>📋 Menu</h2>
  <ul>
    <li><a href="dashboard.php"><span>🏠</span> Dashboard</a></li>
    <li><a href="absensi.php"><span>🕒</span> Absensi</a></li>
    <li><a href="jurnal.php" class="active"><span>📘</span> Jurnal</a></li>
    <li><a href="profil.php"><span>👤</span> Profil</a></li>
    <li><a href="logout.php"><span>🚪</span> Logout</a></li>
  </ul>
</div>

<!-- Konten -->
<div class="content">
  <h1>📘 Jurnal Kegiatan Harian</h1>

  <form method="post">
    <h3>Tanggal: <?= date("d-m-Y"); ?></h3>

    <label>Kegiatan Hari Ini</label>
    <textarea name="kegiatan" required><?= $editData['kegiatan'] ?? '' ?></textarea>

    <label>Kendala yang Dihadapi</label>
    <textarea name="kendala"><?= $editData['kendala'] ?? '' ?></textarea>

    <label>Pembelajaran / Hasil Pekerjaan</label>
    <textarea name="pembelajaran"><?= $editData['pembelajaran'] ?? '' ?></textarea>

    <?php if($editData): ?>
      <input type="hidden" name="id" value="<?= $editData['id'] ?>">
      <button type="submit" name="update">✏️ Update</button>
      <a href="jurnal.php" class="btn hapus">❌ Batal</a>
    <?php else: ?>
      <button type="submit" name="simpan">💾 Simpan</button>
    <?php endif; ?>
  </form>

  <h2 style="text-align:center;">📅 Riwayat Jurnal</h2>
  <table>
    <tr>
      <th>Tanggal</th>
      <th>Kegiatan Hari Ini</th>
      <th>Kendala</th>
      <th>Pembelajaran / Hasil</th>
      <th>Aksi</th>
    </tr>
    <?php
    $jurnal = mysqli_query($conn, "SELECT * FROM jurnal WHERE user_id='$user_id' ORDER BY tanggal DESC, id DESC");
    while($row = mysqli_fetch_assoc($jurnal)){
        echo "<tr>
                <td>".$row['tanggal']."</td>
                <td style='text-align:left;'>".$row['kegiatan']."</td>
                <td style='text-align:left;'>".$row['kendala']."</td>
                <td style='text-align:left;'>".$row['pembelajaran']."</td>
                <td>
                    <a href='jurnal.php?edit=".$row['id']."' class='btn edit'>Edit</a>
                    <a href='jurnal.php?hapus=".$row['id']."' class='btn hapus' onclick='return confirm(\"Hapus data ini?\")'>Hapus</a>
                </td>
              </tr>";
    }
    ?>
  </table>
</div>

<script>
function toggleSidebar(){
  document.getElementById('sidebar').classList.toggle('hidden');
}
</script>
</body>
</html>
