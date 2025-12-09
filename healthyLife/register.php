<?php
include "config/koneksi.php";

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

    // cek apakah email sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($cek) > 0){
        $error = "Email sudah terdaftar!";
    } else {
        $query = mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");
        if($query){
            header("Location: login.php"); // redirect ke login setelah register
            exit;
        } else {
            $error = "Gagal membuat akun!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - HealthyLife</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>Register Akun</h2>
    <?php if(isset($error)){ echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST">
        <label>Nama</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="register">Register</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>
</body>
</html>
