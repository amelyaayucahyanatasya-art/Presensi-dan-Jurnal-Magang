<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$tanggal = date("Y-m-d");
$jam = date("H:i:s");

// Cek apakah sudah absen masuk hari ini
$cek = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id='$user_id' AND tanggal='$tanggal'");
$data_hari_ini = mysqli_fetch_assoc($cek);

// Absen Masuk
if(isset($_POST['absen_masuk'])){
    if(!$data_hari_ini){ // belum absen hari ini
        $status = ($jam <= '08:00:00') ? 'Tepat Waktu' : 'Terlambat';
        mysqli_query($conn, "INSERT INTO absensi (user_id, tanggal, jam_masuk, status) VALUES ('$user_id','$tanggal','$jam','$status')");
        header("Location: absensi.php");
        exit();
    }
}

// Absen Pulang
if(isset($_POST['absen_pulang'])){
    if($data_hari_ini && $data_hari_ini['jam_pulang'] == NULL){
        mysqli_query($conn, "UPDATE absensi SET jam_pulang='$jam' WHERE user_id='$user_id' AND tanggal='$tanggal'");
        header("Location: absensi.php");
        exit();
    }
}

// Ambil data terbaru setelah update
$riwayat = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id='$user_id' ORDER BY tanggal DESC");
$data_hari_ini = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM absensi WHERE user_id='$user_id' AND tanggal='$tanggal'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Absensi</title>
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

.sidebar h2 { text-align: center; color: #3f3f46; font-weight: 600; }

.sidebar ul { list-style: none; padding: 0; }
.sidebar ul li { margin: 10px 0; }
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
.sidebar ul li a:hover,
.sidebar ul li a.active {
  background: rgba(255,255,255,0.6);
}

/* Konten */
.content {
  margin-left: 270px;
  padding: 30px;
  transition: margin-left 0.3s;
  text-align: center;
}
.sidebar.hidden ~ .content { margin-left: 50px; }

/* Tombol Absen */
.absen-buttons form {
  display: inline-block;
  margin: 10px;
}
button {
  padding: 12px 25px;
  border: none;
  border-radius: 10px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  color: white;
  transition: 0.3s;
}
.btn-masuk { background: linear-gradient(135deg,#93c5fd,#a5b4fc); }
.btn-pulang { background: linear-gradient(135deg,#f0abfc,#c084fc); }
button:disabled {
  background: #ccc;
  cursor: not-allowed;
}
button:hover:not(:disabled) { opacity: 0.85; }

/* Tabel Riwayat */
table {
  width: 90%;
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
.status-tepat {
  color: green;
  font-weight: bold;
}
.status-terlambat {
  color: red;
  font-weight: bold;
}
</style>
</head>
<body>

<!-- Tombol Menu -->
<div class="menu-toggle" onclick="toggleSidebar()">☰</div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <h2>📋 Menu</h2>
  <ul>
    <li><a href="dashboard.php"><span>🏠</span> Dashboard</a></li>
    <li><a href="absensi.php" class="active"><span>🕒</span> Absensi</a></li>
    <li><a href="jurnal.php"><span>📘</span> Jurnal</a></li>
    <li><a href="profil.php"><span>👤</span> Profil</a></li>
    <li><a href="logout.php"><span>🚪</span> Logout</a></li>
  </ul>
</div>

<!-- Konten -->
<div class="content">
  <h1>🕒 Absensi Harian</h1>
  <p>Silakan tekan tombol di bawah untuk mencatat kehadiranmu hari ini.</p>

  <div class="absen-buttons">
    <form method="post">
      <button type="submit" name="absen_masuk" class="btn-masuk" 
        <?= ($data_hari_ini) ? 'disabled' : ''; ?>>Absen Masuk</button>
    </form>

    <form method="post">
      <button type="submit" name="absen_pulang" class="btn-pulang"
        <?= (!$data_hari_ini || $data_hari_ini['jam_pulang'] != NULL) ? 'disabled' : ''; ?>>Absen Pulang</button>
    </form>
  </div>

  <h2>📋 Riwayat Absensi</h2>
  <table>
    <tr>
      <th>Tanggal</th>
      <th>Jam Masuk</th>
      <th>Jam Pulang</th>
      <th>Status</th>
    </tr>
    <?php 
    $riwayat = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id='$user_id' ORDER BY tanggal DESC");
    while($row = mysqli_fetch_assoc($riwayat)) { ?>
      <tr>
        <td><?= $row['tanggal']; ?></td>
        <td><?= $row['jam_masuk']; ?></td>
        <td><?= $row['jam_pulang'] ?: '-'; ?></td>
        <td class="<?= ($row['status']=='Tepat Waktu') ? 'status-tepat' : 'status-terlambat'; ?>">
          <?= $row['status']; ?>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>

<script>
function toggleSidebar(){
  document.getElementById('sidebar').classList.toggle('hidden');
}
</script>

</body>
</html>
