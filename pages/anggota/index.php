<?php 
include "../../layout/header.php"; 
include "../../layout/sidebar.php"; 
require "../../config/database.php";

$result = mysqli_query($conn, "SELECT * FROM anggota_perpus ORDER BY id DESC");
?>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>👥 Kelola Data Anggota</h2>
        <a href="tambah.php" class="btn btn-primary btn-sm">Tambah Anggota</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th style="width:140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nis'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['no_hp'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include "../../layout/footer.php"; ?>
