<?php 
include "layout/header.php"; 
include "layout/sidebar.php"; 
?>

<div class="content">
    <h2>Dashboard Perpustakaan 📚</h2>
    <p>Selamat datang di Sistem Informasi Perpustakaan.</p>

    <div class="row mt-4">

        <div class="col-md-3">
            <div class="card shadow p-3">
                <h5>👥 Anggota</h5>
                <p>Kelola data anggota perpustakaan.</p>
                <a href="pages/anggota/index.php" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-3">
                <h5>📘 Buku</h5>
                <p>Kelola daftar buku yang tersedia.</p>
                <a href="pages/daftar_buku/index.php" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-3">
                <h5>📦 Peminjaman</h5>
                <p>Manajemen data peminjaman buku.</p>
                <a href="pages/peminjaman/index.php" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-3">
                <h5>🔄 Pengembalian</h5>
                <p>Proses pengembalian buku.</p>
                <a href="pages/pengembalian/index.php" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>

    </div>
</div>

<?php include "layout/footer.php"; ?>
