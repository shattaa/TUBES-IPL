<?php
require "../../config/database.php";

$id = $_GET['id'];

// Ambil data berdasarkan ID peminjaman
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM peminjaman_buku WHERE id_peminjaman='$id'"));

if(isset($_POST['submit'])){

    $tgl_kembali = $_POST['tgl_kembali'];

    // Hitung telat
    $deadline  = strtotime($data['due']);
    $kembali   = strtotime($tgl_kembali);

    $selisih = ($kembali - $deadline) / 86400;
    $telat = $selisih > 0 ? $selisih : 0;

    // Hitung denda (opsional)
    $denda = $telat * 1000;

    // Insert ke tabel pengembalian
    mysqli_query($conn, 
    "INSERT INTO pengembalian_buku 
    (kode_buku, judul_buku, penulis, penerbit, tahun_terbit, nis, nama_peminjam, return_date, elp, fine)
    VALUES (
        '{$data['kode_buku']}',
        '{$data['judul_buku']}',
        '{$data['penulis']}',
        '{$data['penerbit']}',
        '{$data['tahun_terbit']}',
        '{$data['nis']}',
        '{$data['nama_peminjam']}',
        '$tgl_kembali',
        '$telat',
        '$denda'
    )");

    // Update status buku kembali tersedia
    mysqli_query($conn, "UPDATE daftar_buku SET status='Tersedia' WHERE kode_buku='{$data['kode_buku']}'");

    // Hapus dari tabel peminjaman
    mysqli_query($conn, "DELETE FROM peminjaman_buku WHERE id_peminjaman='$id'");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengembalian Buku</title>
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

        p {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
        }

        input[type="date"] {
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
            background: #28a745;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        button:hover {
            background: #218838;
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
    <h2>Proses Pengembalian Buku</h2>

    <p><b>Judul Buku:</b> <?= $data['judul_buku']; ?></p>
    <p><b>Peminjam:</b> <?= $data['nama_peminjam']; ?></p>
    <p><b>Tanggal Pinjam:</b> <?= date('d-m-Y', strtotime($data['date'])); ?></p>
    <p><b>Deadline:</b> <?= date('d-m-Y', strtotime($data['due'])); ?></p>

    <form method="post">
        <label>Tanggal Dikembalikan:</label>
        <input type="date" name="tgl_kembali" required>

        <button name="submit">Simpan Pengembalian</button>
    </form>

    <a href="index.php" class="back-link">⬅ Kembali</a>
</div>

</body>
</html>
