<?php
session_start();
include "config/koneksi.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

// Delete hanya jika catatan milik user
$query = mysqli_query($conn, "DELETE FROM daily_note WHERE note_id=$id AND user_id='$user_id'");
header("Location: index.php");
exit;
?>
