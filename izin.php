<?php
// izin.php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");
$user_id = $_SESSION['user_id'];

// admin redirect
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: admin_dashboard.php");
    exit;
}

$qUser = mysqli_query($conn, "SELECT * FROM users WHERE id='".intval($user_id)."' LIMIT 1");
$user = mysqli_fetch_assoc($qUser);

$msg = "";
// Ajukan izin (jika ada form independen)
if (isset($_POST['ajukan_izin'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alasan = mysqli_real_escape_string($conn, $_POST['alasan']);
    $buktiPath = '';
    if (!empty($_FILES['bukti']['name'])) {
        if (!is_dir('uploads')) mkdir('uploads',0755,true);
        $buktiPath = 'uploads/'.time().'_'.basename($_FILES['bukti']['name']);
        move_uploaded_file($_FILES['bukti']['tmp_name'], $buktiPath);
    }
    mysqli_query($conn, "INSERT INTO izin (user_id,nama,alasan,bukti,tanggal,status) VALUES ('".intval($user_id)."','".mysqli_real_escape_string($conn,$nama)."','".mysqli_real_escape_string($conn,$alasan)."','".mysqli_real_escape_string($conn,$buktiPath)."','".date('Y-m-d')."','Menunggu')");
    $msg = "Izin dikirim.";
}

// Ambil list izin user
$list = mysqli_query($conn, "SELECT * FROM izin WHERE user_id='".intval($user_id)."' ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Izin Tidak Masuk</title>
<link rel="stylesheet" href="style.css">
<style>
.container{max-width:900px;margin:18px auto;padding:0 15px}
.card{background:#fff;padding:16px;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,0.06);margin-bottom:12px}
.input, textarea{width:100%;padding:8px;border:1px solid #ddd;border-radius:8px;margin-bottom:10px}
.btn{padding:10px 14px;border-radius:8px;border:none;background:linear-gradient(135deg,#93c5fd,#f0abfc);color:#fff}
.small{font-size:13px;color:#555}
</style>
</head>
<body>
<div class="container">
  <div class="card">
    <h3>Ajukan Izin Tidak Masuk</h3>
    <?php if($msg) echo "<p class='small'>$msg</p>"; ?>
    <form method="post" enctype="multipart/form-data">
      <input class="input" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required>
      <textarea class="input" name="alasan" placeholder="Alasan..." required></textarea>
      <label>Bukti (foto/pdf) - opsional</label><br>
      <input type="file" name="bukti" accept="image/*,.pdf"><br><br>
      <button class="btn" type="submit" name="ajukan_izin">Kirim Izin</button>
    </form>
  </div>

  <div class="card">
    <h3>Riwayat Izin</h3>
    <?php if(mysqli_num_rows($list) == 0) echo "<p>Tidak ada riwayat izin.</p>"; ?>
    <?php while($r = mysqli_fetch_assoc($list)): ?>
      <div style="border:1px solid #f0f0f0;padding:12px;border-radius:8px;margin-bottom:8px">
        <small><?= $r['tanggal'] ?> — Status: <?= htmlspecialchars($r['status']) ?></small>
        <p><strong>Nama:</strong> <?= htmlspecialchars($r['nama']) ?></p>
        <p><strong>Alasan:</strong> <?= nl2br(htmlspecialchars($r['alasan'])) ?></p>
        <?php if(!empty($r['bukti'])): ?>
          <p><strong>Bukti:</strong> <a href="<?= htmlspecialchars($r['bukti']) ?>" target="_blank">Lihat</a></p>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
</div>
</body>
</html>
