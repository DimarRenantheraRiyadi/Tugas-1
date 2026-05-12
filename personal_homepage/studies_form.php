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
include 'models/Level.php';

$studies = new Studies($conn);
$level = new Level($conn);
$isEdit = (isset($_GET['action']) && $_GET['action'] == 'edit');

if ($isEdit && isset($_GET['id'])) {
    $studies->id = $_GET['id'];
    $studies->readOne();
}
?>

<h2 class="mb-4"><?= $isEdit ? 'Edit' : 'Tambah' ?> Studies</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="studiesController.php?action=<?= $isEdit ? 'update' : 'create' ?>" method="POST" enctype="multipart/form-data">
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $studies->id ?>">
                <input type="hidden" name="old_foto" value="<?= $studies->foto_sekolah ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">Nama Sekolah/Kampus</label>
                <input type="text" name="nama" class="form-control" value="<?= $isEdit ? htmlspecialchars($studies->nama) : '' ?>" placeholder="Nama institusi" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Level</label>
                <select name="idlevel" class="form-select" required>
                    <option value="">-- Pilih Level --</option>
                    <?php
                    $resultLevel = $level->readAll();
                    while ($lev = mysqli_fetch_assoc($resultLevel)):
                        $selected = ($isEdit && $studies->idlevel == $lev['id']) ? 'selected' : '';
                    ?>
                        <option value="<?= $lev['id'] ?>" <?= $selected ?>><?= $lev['nama'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Jurusan atau keterangan lainnya"><?= $isEdit ? htmlspecialchars($studies->keterangan) : '' ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun Lulus</label>
                <input type="number" name="tahun_lulus" class="form-control" value="<?= $isEdit ? $studies->tahun_lulus : '' ?>" placeholder="Contoh: 2020" min="1990" max="2030">
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Sekolah/Kampus</label>
                <?php if ($isEdit && !empty($studies->foto_sekolah)): ?>
                    <div class="mb-2">
                        <img src="<?= $studies->foto_sekolah ?>" alt="Current" width="150" class="rounded">
                        <small class="text-muted d-block">Foto saat ini</small>
                    </div>
                <?php endif; ?>
                <input type="file" name="foto_sekolah" class="form-control" accept="image/*">
                <small class="text-muted"><?= $isEdit ? 'Kosongkan jika tidak ingin mengubah foto' : 'Format: JPG, PNG, GIF' ?></small>
            </div>

            <button type="submit" class="btn btn-success">💾 Simpan</button>
            <a href="index.php?page=studies_list" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>