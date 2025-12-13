<?php 
require "../../config/database.php";

if(isset($_POST['simpan'])){
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($conn, "INSERT INTO anggota_perpus (nis, nama, alamat, no_hp)
    VALUES ('$nis', '$nama', '$alamat', '$no_hp')");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota</title>
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
            background: #007bff;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        button:hover {
            background: #005dc1;
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
    <h2>Tambah Anggota</h2>

    <form method="post">
        <label>NIS:</label>
        <input type="text" name="nis" required>

        <label>Nama:</label>
        <input type="text" name="nama" required>

        <label>Alamat:</label>
        <textarea name="alamat" required></textarea>

        <label>No HP:</label>
        <input type="text" name="no_hp" required>

        <button name="simpan">Simpan</button>
    </form>

    <a href="index.php" class="back-link">⬅ Kembali</a>
</div>

</body>
</html>
