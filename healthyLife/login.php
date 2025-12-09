<?php
session_start();
include "config/koneksi.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if($user && password_verify($password, $user['password'])){
        // password benar, buat session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        header("Location: index.php"); // redirect ke halaman utama
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - HealthyLife</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if(isset($error)){ echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</div>
</body>
</html>
