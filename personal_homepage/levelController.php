<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

include_once 'koneksi.php';
include_once 'models/Level.php';

$level = new Level($conn);
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'create' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $level->nama = $_POST['nama'];
    $level->create();
    header('Location: index.php?page=level_list&msg=created');
    exit;
}

if ($action == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $level->id = $_POST['id'];
    $level->nama = $_POST['nama'];
    $level->update();
    header('Location: index.php?page=level_list&msg=updated');
    exit;
}

if ($action == 'delete') {
    $level->id = $_GET['id'];
    $result = $level->delete();
    if ($result === true) {
        header('Location: index.php?page=level_list&msg=deleted');
    } elseif ($result === "ada_relasi") {
        header('Location: index.php?page=level_list&msg=has_relation');
    } else {
        header('Location: index.php?page=level_list&msg=error');
    }
    exit;
}

header('Location: index.php?page=level_list');
exit;
?>