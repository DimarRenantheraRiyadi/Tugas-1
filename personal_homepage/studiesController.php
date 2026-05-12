<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

include_once 'koneksi.php';
include_once 'models/Studies.php';

$studies = new Studies($conn);
$action = isset($_GET['action']) ? $_GET['action'] : '';

$upload_dir = 'img/schools/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if ($action == 'create' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $studies->nama = $_POST['nama'];
    $studies->idlevel = $_POST['idlevel'];
    $studies->keterangan = $_POST['keterangan'];
    $studies->tahun_lulus = $_POST['tahun_lulus'];

    if (isset($_FILES['foto_sekolah']) && $_FILES['foto_sekolah']['error'] == 0) {
        $foto_name = time() . '_' . basename($_FILES['foto_sekolah']['name']);
        move_uploaded_file($_FILES['foto_sekolah']['tmp_name'], $upload_dir . $foto_name);
        $studies->foto_sekolah = $upload_dir . $foto_name;
    } else {
        $studies->foto_sekolah = '';
    }

    $studies->create();
    header('Location: index.php?page=studies_list&msg=created');
    exit;
}

if ($action == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $studies->id = $_POST['id'];
    $studies->nama = $_POST['nama'];
    $studies->idlevel = $_POST['idlevel'];
    $studies->keterangan = $_POST['keterangan'];
    $studies->tahun_lulus = $_POST['tahun_lulus'];

    if (isset($_FILES['foto_sekolah']) && $_FILES['foto_sekolah']['error'] == 0) {
        if (!empty($_POST['old_foto']) && file_exists($_POST['old_foto'])) {
            unlink($_POST['old_foto']);
        }
        $foto_name = time() . '_' . basename($_FILES['foto_sekolah']['name']);
        move_uploaded_file($_FILES['foto_sekolah']['tmp_name'], $upload_dir . $foto_name);
        $studies->foto_sekolah = $upload_dir . $foto_name;
    } else {
        $studies->foto_sekolah = $_POST['old_foto'];
    }

    $studies->update();
    header('Location: index.php?page=studies_list&msg=updated');
    exit;
}

if ($action == 'delete') {
    $studies->id = $_GET['id'];
    $studies->readOne();
    if (!empty($studies->foto_sekolah) && file_exists($studies->foto_sekolah)) {
        unlink($studies->foto_sekolah);
    }
    $studies->delete();
    header('Location: index.php?page=studies_list&msg=deleted');
    exit;
}

header('Location: index.php?page=studies_list');
exit;
?>