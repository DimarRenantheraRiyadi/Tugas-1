<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

include 'koneksi.php';
include 'models/Studies.php';
?>

<h2 class="mb-4">🎓 Data Studies</h2>

<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] == 'created'): ?>
        <div class="alert alert-success">✅ Data studi berhasil ditambahkan!</div>
    <?php elseif ($_GET['msg'] == 'updated'): ?>
        <div class="alert alert-info">✅ Data studi berhasil diupdate!</div>
    <?php elseif ($_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-warning">✅ Data studi berhasil dihapus!</div>
    <?php endif; ?>
<?php endif; ?>

<a href="index.php?page=studies_form&action=add" class="btn btn-primary mb-3">+ Tambah Studies</a>

<table class="table table-striped table-hover shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Sekolah/Kampus</th>
            <th>Level</th>
            <th>Keterangan</th>
            <th>Tahun Lulus</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $studies = new Studies($conn);
        $result = $studies->readAll();
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td>
                <?php if (!empty($row['foto_sekolah'])): ?>
                    <img src="<?= $row['foto_sekolah'] ?>" alt="Foto" width="60" class="rounded">
                <?php else: ?>
                    <span class="text-muted">No foto</span>
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><span class="badge bg-info"><?= htmlspecialchars($row['nama_level']) ?></span></td>
            <td><?= htmlspecialchars($row['keterangan']) ?></td>
            <td><?= $row['tahun_lulus'] ?></td>
            <td class="text-center">
                <a href="index.php?page=studies_form&action=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="studiesController.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        <?php if (mysqli_num_rows($result) == 0): ?>
        <tr>
            <td colspan="7" class="text-center text-muted">Belum ada data studies</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>