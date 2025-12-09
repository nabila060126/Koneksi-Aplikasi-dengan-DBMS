<?php
session_start();
include "config/koneksi.php";

// Cek apakah user sudah login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil kata kunci pencarian
$key = isset($_GET['key']) ? $_GET['key'] : '';

// Query hanya catatan milik user yang login
$query = mysqli_query($conn, "SELECT * FROM daily_note 
                             WHERE user_id='$user_id' 
                             AND (title LIKE '%$key%' OR description LIKE '%$key%') 
                             ORDER BY note_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>Hasil Pencarian: "<?= htmlspecialchars($key) ?>"</h2>
    <a href="index.php"><button>Kembali</button></a>

    <table>
        <tr>
            <th>Tanggal</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Prioritas</th>
            <th>Aksi</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($query)){ ?>
        <tr>
            <td><?= htmlspecialchars($row['note_date']) ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['category']) ?></td>
            <td><?= htmlspecialchars($row['priority']) ?></td>
            <td class="actions">
                <a href="edit.php?id=<?= $row['note_id'] ?>"><button>Edit</button></a>
                <a href="delete.php?id=<?= $row['note_id'] ?>" onclick="return confirm('Hapus catatan?')"><button>Hapus</button></a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
