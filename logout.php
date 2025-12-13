<?php
session_start();

// Simpan pesan logout
$_SESSION['message'] = "Anda sudah logout";

// Hapus data login saja, tapi jangan session_destroy()
unset($_SESSION['login']); // hapus session login

// Redirect ke login
header("Location: login.php");
exit();
?>
