<?php
require "../../config/database.php";
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM peminjaman_buku WHERE id='$id'"));

if(isset($_POST['update'])) {
    $tgl_kembali = $_POST['tgl_kembali'];
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE peminjaman_buku SET tgl_kembali='$tgl_kembali', status='$status' WHERE id='$id'");

    if($status == "Dikembalikan") {
        mysqli_query($conn, "UPDATE daftar_buku SET status='Tersedia' WHERE kode_buku='{$data['kode_buku']}'");
    }

    header("Location: index.php");
    exit;
}
?>

<h2>Edit Peminjaman</h2>
<form method="post">
    Tanggal Kembali: <input type="date" name="tgl_kembali" value="<?= $data['tgl_kembali']; ?>" required><br><br>
    
    Status:
    <select name="status">
        <option <?= $data['status']=="Dipinjam"?'selected':'' ?>>Dipinjam</option>
        <option <?= $data['status']=="Dikembalikan"?'selected':'' ?>>Dikembalikan</option>
    </select>
    <br><br>

    <button name="update">Update</button>
</form>

<br>
<a href="index.php">Kembali</a>
