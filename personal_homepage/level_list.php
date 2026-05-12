<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

include 'koneksi.php';
include 'models/Level.php';
?>

<h2 class="mb-4">📚 Data Level</h2>

<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] == 'created'): ?>
        <div class="alert alert-success">✅ Level berhasil ditambahkan!</div>
    <?php elseif ($_GET['msg'] == 'updated'): ?>
        <div class="alert alert-info">✅ Level berhasil diupdate!</div>
    <?php elseif ($_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-warning">✅ Level berhasil dihapus!</div>
    <?php elseif ($_GET['msg'] == 'has_relation'): ?>
        <div class="alert alert-danger">❌ Level tidak bisa dihapus karena masih ada data Studies terkait!</div>
    <?php endif; ?>
<?php endif; ?>

<a href="index.php?page=level_form&action=add" class="btn btn-primary mb-3">+ Tambah Level</a>

<table class="table table-striped table-hover shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Level</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $level = new Level($conn);
        $result = $level->readAll();
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td class="text-center">
                <a href="controller/levelController.php?action=delete...
                <a href="controller/levelController.php?action=edit...&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                <a href="controller/levelController.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus level ini?')">🗑️ Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        <?php if (mysqli_num_rows($result) == 0): ?>
        <tr>
            <td colspan="3" class="text-center text-muted">Belum ada data level</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>