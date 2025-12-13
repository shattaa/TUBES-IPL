<?php
require "../../config/database.php";
$id = $_GET['id'];

// Ambil kode buku agar status bisa dikembalikan
$cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT kode_buku FROM peminjaman_buku WHERE id_peminjaman='$id'"));
$kode = $cek['kode_buku'];

mysqli_query($conn, "DELETE FROM peminjaman_buku WHERE id_peminjaman='$id'");
mysqli_query($conn, "UPDATE daftar_buku SET status='Tersedia' WHERE kode_buku='$kode'");

header("Location: index.php");
exit;
