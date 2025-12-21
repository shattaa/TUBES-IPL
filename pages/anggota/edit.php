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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota</title>

    <!-- ✅ STYLE DITAMBAHKAN (KONSISTEN DENGAN HALAMAN LAIN) -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-box {
            width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 60px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #ffc107;
            border: none;
            border-radius: 8px;
            color: #000;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        button:hover {
            background: #e0a800;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Edit Anggota</h2>

    <form method="post">

        <label>NIS</label>
        <input type="text" name="nis" value="<?= $data['nis'] ?>" required>

        <label>Nama</label>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required>

        <label>Alamat</label>
        <textarea name="alamat" required><?= $data['alamat'] ?></textarea>

        <label>No HP</label>
        <input type="text" name="no_hp" value="<?= $data['no_hp'] ?>" required>

        <button name="update">Update</button>
    </form>

    <a href="index.php" class="back-link">⬅ Kembali</a>
</div>

</body>
</html>
