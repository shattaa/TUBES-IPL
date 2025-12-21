<?php
require "../../config/database.php";
$data = mysqli_query($conn, "SELECT * FROM peminjaman_buku");

include "../../layout/header.php";
include "../../layout/sidebar.php";
?>

<div class="content">

    <h2 class="fw-bold mb-2">🔄 Daftar Pengembalian Buku</h2>
    <p class="text-muted">Pilih buku yang akan diproses pengembaliannya.</p>

    <a href="../../index.php" class="btn btn-secondary btn-sm mb-3">
        ⬅ Kembali ke Dashboard
    </a>

    <div class="card shadow-sm p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-warning">
                    <tr>
                        <th>ID</th>
                        <th>Judul Buku</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Deadline</th>
                        <th>Estimasi Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php while($row = mysqli_fetch_assoc($data)): ?>
                    <?php
                        // ===============================
                        // HITUNG ESTIMASI DENDA
                        // ===============================
                        $hari_ini = strtotime(date('Y-m-d'));
                        $deadline = strtotime($row['due']);

                        $telat = ($hari_ini - $deadline) / 86400;
                        $telat = $telat > 0 ? floor($telat) : 0;

                        $denda = $telat * 2000;
                    ?>
                    <tr>
                        <td><?= $row['id_peminjaman'] ?></td>
                        <td><?= $row['judul_buku'] ?></td>
                        <td><?= $row['nama_peminjam'] ?></td>
                        <td><?= date('d-m-Y', strtotime($row['date'])) ?></td>
                        <td><?= date('d-m-Y', strtotime($row['due'])) ?></td>

                        <!-- UI DENDA -->
                        <td>
                            <?php if($telat > 0): ?>
                                <span class="badge bg-danger">
                                    Rp <?= number_format($denda, 0, ',', '.') ?>
                                </span>
                                <br>
                                <small class="text-danger">
                                    Telat <?= $telat ?> hari
                                </small>
                            <?php else: ?>
                                <span class="badge bg-success">
                                    Rp 0
                                </span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="proses.php?id=<?= $row['id_peminjaman'] ?>" 
                               class="btn btn-success btn-sm">
                               ✔ Kembalikan
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<?php include "../../layout/footer.php"; ?>
