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

$level = new Level($conn);
$isEdit = (isset($_GET['action']) && $_GET['action'] == 'edit');

if ($isEdit && isset($_GET['id'])) {
    $level->id = $_GET['id'];
    $level->readOne();
}
?>

<h2 class="mb-4"><?= $isEdit ? 'Edit' : 'Tambah' ?> Level</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="levelController.php?action=<?= $isEdit ? 'update' : 'create' ?>" method="POST">
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $level->id ?>">
            <?php endif; ?>
            
            <div class="mb-3">
                <label class="form-label">Nama Level</label>
                <input type="text" name="nama" class="form-control" value="<?= $isEdit ? htmlspecialchars($level->nama) : '' ?>" placeholder="Contoh: SD, SMP, SMA, S1" required>
            </div>

            <button type="submit" class="btn btn-success">💾 Simpan</button>
            <a href="index.php?page=level_list" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>