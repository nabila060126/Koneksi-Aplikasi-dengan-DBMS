<?php
session_start();
include "config/koneksi.php";

// Cek apakah user sudah login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $note_date = $_POST['note_date'];
    $category = $_POST['category'];
    $priority = $_POST['priority'];
    $description = $_POST['description'];

    // Insert catatan dengan user_id dari session
    $query = mysqli_query($conn, "INSERT INTO daily_note(user_id, note_date, title, category, priority, description) 
                                 VALUES('$user_id','$note_date','$title','$category','$priority','$description')");

    if($query){
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambahkan catatan";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Catatan - HealthyLife</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Catatan Harian</h2>
    <a href="index.php"><button>Kembali ke Daftar</button></a>
    <form method="POST">
        <label>Judul</label>
        <input type="text" name="title" required>
        
        <label>Tanggal</label>
        <input type="date" name="note_date" required>
        
        <label>Kategori</label>
        <select name="category" required>
            <option>Olahraga</option>
            <option>Nutrisi</option>
            <option>Tidur</option>
            <option>Pekerjaan</option>
            <option>Personal</option>
            <option>Kesehatan</option>
        </select>
        
        <label>Prioritas</label>
        <select name="priority" required>
            <option>Rendah</option>
            <option>Sedang</option>
            <option>Tinggi</option>
            <option>Urgent</option>
        </select>
        
        <label>Deskripsi</label>
        <textarea name="description"></textarea>
        
        <button type="submit" name="submit">Simpan</button>
    </form>
</div>
</body>
</html>
