<?php
require "../../config/database.php";

$kode = $_GET['kode'];
mysqli_query($conn, "DELETE FROM daftar_buku WHERE kode_buku='$kode'");

header("Location: index.php");
exit;
