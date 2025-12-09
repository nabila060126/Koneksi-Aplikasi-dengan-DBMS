<<?php
session_start();
include "config/koneksi.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

// Ambil data catatan milik user yang login
$data = mysqli_query($conn, "SELECT * FROM daily_note WHERE note_id=$id AND user_id='$user_id'");
$row = mysqli_fetch_assoc($data);

if(!$row){
    die("Catatan tidak ditemukan atau tidak boleh diedit!");
}

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $note_date = $_POST['note_date'];
    $category = $_POST['category'];
    $priority = $_POST['priority'];
    $description = $_POST['description'];

    $query = mysqli_query($conn, "UPDATE daily_note SET 
                                   title='$title', note_date='$note_date', category='$category', 
                                   priority='$priority', description='$description' 
                                   WHERE note_id=$id AND user_id='$user_id'");

    if($query){
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal update catatan";
    }
}
?>

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Catatan</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>Edit Catatan</h2>
    <form method="POST">
        <label>Judul</label>
        <input type="text" name="title" value="<?= $row['title'] ?>" required>
        
        <label>Tanggal</label>
        <input type="date" name="note_date" value="<?= $row['note_date'] ?>" required>
        
        <label>Kategori</label>
        <select name="category">
            <option <?= $row['category']=='Olahraga'?'selected':'' ?>>Olahraga</option>
            <option <?= $row['category']=='Nutrisi'?'selected':'' ?>>Nutrisi</option>
            <option <?= $row['category']=='Tidur'?'selected':'' ?>>Tidur</option>
            <option <?= $row['category']=='Pekerjaan'?'selected':'' ?>>Pekerjaan</option>
            <option <?= $row['category']=='Personal'?'selected':'' ?>>Personal</option>
            <option <?= $row['category']=='Kesehatan'?'selected':'' ?>>Kesehatan</option>
        </select>
        
        <label>Prioritas</label>
        <select name="priority">
            <option <?= $row['priority']=='Rendah'?'selected':'' ?>>Rendah</option>
            <option <?= $row['priority']=='Sedang'?'selected':'' ?>>Sedang</option>
            <option <?= $row['priority']=='Tinggi'?'selected':'' ?>>Tinggi</option>
            <option <?= $row['priority']=='Urgent'?'selected':'' ?>>Urgent</option>
        </select>
        
        <label>Deskripsi</label>
        <textarea name="description"><?= $row['description'] ?></textarea>
        
        <button type="submit" name="submit">Update</button>
    </form>
</div>
</body>
</html>
