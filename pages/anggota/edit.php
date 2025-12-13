<?php
require "../../config/database.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM anggota_perpus WHERE id='$id'"));

if(isset($_POST['update'])){
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($conn, "UPDATE anggota_perpus SET 
        nis='$nis',
        nama='$nama',
        alamat='$alamat',
        no_hp='$no_hp'
        WHERE id='$id'
    ");

    header("Location: index.php");
    exit;
}
?>

<h2>Edit Anggota</h2>
<form method="post">
    NIS:<br> <input type="text" name="nis" value="<?= $data['nis'] ?>" required><br><br>
    Nama:<br> <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>
    Alamat:<br> <textarea name="alamat" required><?= $data['alamat'] ?></textarea><br><br>
    No HP:<br> <input type="text" name="no_hp" value="<?= $data['no_hp'] ?>" required><br><br>

    <button name="update">Update</button>
</form>

<br><a href="index.php">⬅ Kembali</a>
