<?php  
require "../../config/database.php";
$result = mysqli_query($conn, "SELECT * FROM peminjaman_buku");

include "../../layout/header.php";
include "../../layout/sidebar.php";
?>

<div class="content">

    <h2 class="fw-bold mb-2">📦 Data Peminjaman Buku</h2>
    <p class="text-muted">Berikut daftar semua peminjaman buku yang sedang berlangsung maupun riwayat.</p>

    <div class="card shadow-sm p-4 mt-3">

        <div class="d-flex justify-content-between mb-3">
            <h5 class="fw-bold">Daftar Peminjaman</h5>
            <a href="tambah.php" class="btn btn-primary btn-sm">+ Tambah Peminjaman</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Judul Buku</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Total Hari</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id_peminjaman'] ?></td>
                        <td><?= $row['judul_buku'] ?></td>
                        <td><?= $row['nama_peminjam'] ?></td>
                        <td><?= date('d-m-Y', strtotime($row['date'])) ?></td>
                        <td><?= date('d-m-Y', strtotime($row['due'])) ?></td>
                        <td><span class="badge bg-info text-dark"><?= $row['total_hari'] ?> Hari</span></td>
                        <td>
                            <a href="delete.php?id=<?= $row['id_peminjaman'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>

    <a href="../../index.php" class="btn btn-secondary btn-sm mt-4">Kembali ke Dashboard</a>

</div>

<?php include "../../layout/footer.php"; ?>
