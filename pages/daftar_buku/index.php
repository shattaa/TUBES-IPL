<?php
include "../../layout/header.php";
include "../../layout/sidebar.php";
require "../../config/database.php";

// Search filter
$keyword = isset($_GET['search']) ? $_GET['search'] : "";

// Pagination
$limit = 5; // jumlah data per halaman
$page  = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query data buku berdasarkan search
$query = "SELECT * FROM daftar_buku 
          WHERE judul LIKE '%$keyword%'
          OR penulis LIKE '%$keyword%'
          OR penerbit LIKE '%$keyword%'
          OR kode_buku LIKE '%$keyword%'";

$totalRows = mysqli_num_rows(mysqli_query($conn, $query));
$totalPages = ceil($totalRows / $limit);

$result = mysqli_query($conn, "$query LIMIT $start, $limit");
?>

<div class="content">
    <h2>📘 Daftar Buku</h2>

    <a href="tambah.php" class="btn btn-success btn-sm mb-3">+ Tambah Buku</a>

    <form method="get" class="mb-3" style="display:flex; gap:10px; width:350px;">
        <input type="text" name="search" value="<?= $keyword ?>" 
               placeholder="Cari judul / penulis / kode..." class="form-control">
        <button class="btn btn-primary btn-sm">Cari</button>
        <a href="index.php" class="btn btn-secondary btn-sm">Reset</a>
    </form>

    <table class="table table-bordered table-striped">
        <tr class="table-primary">
            <th>Kode Buku</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['kode_buku']; ?></td>
                    <td><?= $row['judul']; ?></td>
                    <td><?= $row['penulis']; ?></td>
                    <td><?= $row['penerbit']; ?></td>
                    <td><?= $row['tahun_terbit']; ?></td>
                    <td>
                        <span class="badge bg-<?= ($row['status'] == 'Tersedia') ? 'success' : 'danger'; ?>">
                            <?= $row['status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="edit.php?kode=<?= $row['kode_buku']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?kode=<?= $row['kode_buku']; ?>" 
                           onclick="return confirm('Yakin hapus buku ini?')" 
                           class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">❌ Tidak ada data ditemukan.</td></tr>
        <?php endif; ?>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= $keyword ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php include "../../layout/footer.php"; ?>
