<?php
session_start();
include "config/koneksi.php";

// Cek apakah user sudah login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// Ambil user_id dan nama dari session
$user_id = $_SESSION['user_id'];
$user_name = isset($_SESSION['name']) ? $_SESSION['name'] : "User";

// Ambil catatan user yang login
$query = mysqli_query($conn, "SELECT * FROM daily_note WHERE user_id='$user_id' ORDER BY note_date DESC");

// Cek apakah query berhasil
if(!$query){
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>HealthyLife - Jadwal Hidup Sehat</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>HealthyLife</h1>
        <h2>Selamat Hidup Sehat, <?= htmlspecialchars($user_name) ?></h2>

        <!-- Tombol Logout -->
        <a href="logout.php"><button class="logout">Logout</button></a>
        <!-- Tombol Tambah Catatan -->
        <a href="add.php"><button>Tambah Catatan</button></a>

        <table>
            <tr>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Prioritas</th>
                <th>Aksi</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
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
