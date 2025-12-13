<?php
require "../../config/database.php";

if (isset($_POST['simpan'])) {
    $kode = $_POST['kode'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $status = $_POST['status'];

    mysqli_query($conn, "INSERT INTO daftar_buku (kode_buku, judul, penulis, penerbit, tahun_terbit, status) 
    VALUES ('$kode', '$judul', '$penulis', '$penerbit', '$tahun', '$status')");
    
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
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
            width: 450px;
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

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
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
    <h2>Tambah Buku</h2>

    <form method="post">
        <label>Kode Buku:</label>
        <input type="text" name="kode" required>

        <label>Judul Buku:</label>
        <input type="text" name="judul" required>

        <label>Penulis:</label>
        <input type="text" name="penulis" required>

        <label>Penerbit:</label>
        <input type="text" name="penerbit" required>

        <label>Tahun Terbit:</label>
        <input type="number" name="tahun" required>

        <label>Status:</label>
        <select name="status">
            <option value="Tersedia">Tersedia</option>
            <option value="Dipinjam">Dipinjam</option>
        </select>

        <button name="simpan">Simpan</button>
    </form>

    <a href="index.php" class="back-link">⬅ Kembali</a>
</div>

</body>
</html>
