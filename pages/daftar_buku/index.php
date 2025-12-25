<?php
include "../../layout/header.php";
include "../../layout/sidebar.php";
require "../../config/database.php";

$keyword = $_GET['search'] ?? '';

$limit = 5;
$page  = $_GET['page'] ?? 1;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM daftar_buku
          WHERE judul LIKE '%$keyword%'
          OR penulis LIKE '%$keyword%'
          OR penerbit LIKE '%$keyword%'
          OR kode_buku LIKE '%$keyword%'";

$totalRows  = mysqli_num_rows(mysqli_query($conn, $query));
$totalPages = ceil($totalRows / $limit);

$result = mysqli_query($conn, "$query LIMIT $start, $limit");
?>

<div class="content">

<h2>📘 Daftar Buku</h2>

<a href="tambah.php" class="btn btn-success mb-3">+ Tambah Buku</a>

<!-- SEARCH BOX -->
<form method="get" class="search-box mb-4">
    <input
        type="text"
        name="search"
        value="<?= htmlspecialchars($keyword) ?>"
        placeholder="Cari judul / penulis / kode..."
        class="form-control search-input-full"
    >

    <div class="search-actions">
        <button type="submit" class="btn btn-primary">Cari</button>
        <a href="index.php" class="btn btn-secondary">Reset</a>
    </div>
</form>

<table class="table table-bordered table-striped">
<tr class="table-primary">
    <th>Kode</th>
    <th>Judul</th>
    <th>Penulis</th>
    <th>Penerbit</th>
    <th>Tahun</th>
    <th>Stok</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php if(mysqli_num_rows($result) > 0): ?>
<?php while($r = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?= $r['kode_buku'] ?></td>
    <td><?= $r['judul'] ?></td>
    <td><?= $r['penulis'] ?></td>
    <td><?= $r['penerbit'] ?></td>
    <td><?= $r['tahun_terbit'] ?></td>
    <td><?= $r['stok'] ?></td>
    <td>
        <span class="badge bg-<?= ($r['stok'] > 0) ? 'success' : 'danger' ?>">
            <?= ($r['stok'] > 0) ? 'Tersedia' : 'Habis' ?>
        </span>
    </td>
    <td>
        <a href="edit.php?kode=<?= $r['kode_buku'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete.php?kode=<?= $r['kode_buku'] ?>"
           onclick="return confirm('Yakin hapus buku ini?')"
           class="btn btn-danger btn-sm">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
    <td colspan="8" class="text-center">❌ Tidak ada data ditemukan</td>
</tr>
<?php endif; ?>
</table>

<ul class="pagination">
<?php for($i = 1; $i <= $totalPages; $i++): ?>
<li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
    <a class="page-link" href="?page=<?= $i ?>&search=<?= $keyword ?>">
        <?= $i ?>
    </a>
</li>
<?php endfor; ?>
</ul>

</div>

<?php include "../../layout/footer.php"; ?>
