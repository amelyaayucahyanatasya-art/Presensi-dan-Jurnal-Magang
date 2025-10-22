<?php
include 'config.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $asal_sekolah = $_POST['asal_sekolah'];
    $gender = $_POST['gender'];
    $foto = "";

    if (!empty($_FILES['foto']['name'])) {
        $foto = "uploads/" . time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    }

    // Cek email sudah ada atau belum
    $cek_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek_email) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $query = mysqli_query($conn, "INSERT INTO users (nama, email, password, asal_sekolah, jenis_kelamin, foto) VALUES ('$nama', '$email', '$password', '$asal_sekolah', '$gender', '$foto')");
        if ($query) {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['nama'] = $nama;
            $_SESSION['foto'] = $foto;
            header("Location: dashboard.php");
        } else {
            $error = "Pendaftaran gagal.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Akun Baru</title>
<link rel="stylesheet" href="style.css">
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #f8e8ff, #e0f7ff, #fef6d8);
    font-family: 'Poppins', sans-serif;
}

.register-container {
    background: white;
    padding: 40px 35px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    width: 380px;
    text-align: center;
}

.register-container h2 {
    margin-bottom: 25px;
    color: #5a5a89;
}

.register-container input,
.register-container select {
    width: 90%;
    padding: 10px;
    margin: 8px 0;
    border-radius: 10px;
    border: 1px solid #ccc;
    background-color: #fafafa;
}

.register-container input[type="file"] {
    border: none;
}

.register-container .gender {
    display: flex;
    justify-content: space-around;
    margin: 10px 0;
}

.register-container button {
    width: 95%;
    padding: 12px;
    margin-top: 15px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #93c5fd, #f0abfc);
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.register-container button:hover {
    background: linear-gradient(135deg, #60a5fa, #e879f9);
}

.register-container p {
    margin-top: 15px;
    font-size: 14px;
}

.register-container a {
    color: #6366f1;
    text-decoration: none;
}

.register-container a:hover {
    text-decoration: underline;
}

.error-message {
    color: red;
    margin-bottom: 10px;
    font-weight: 500;
}
</style>
</head>
<body>

<div class="register-container">
    <h2>Daftar Akun Baru</h2>

    <?php if(isset($error)) echo "<div class='error-message'>$error</div>"; ?>

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="asal_sekolah" placeholder="Asal Sekolah" required>

        <div class="gender">
            <label><input type="radio" name="gender" value="L" required> Laki-Laki</label>
            <label><input type="radio" name="gender" value="P" required> Perempuan</label>
        </div>

        <label>Foto Profil:</label>
        <input type="file" name="foto" required>

        <button type="submit" name="register">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="index.php">Login di sini</a></p>
</div>

</body>
</html>
