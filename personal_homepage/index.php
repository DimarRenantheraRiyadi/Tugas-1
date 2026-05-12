<?php
include 'header.php';
include 'menu.php';
?>

<!-- MAIN CONTENT AREA -->
<div class="container mt-4">
    <div class="row">
        <!-- SIDEBAR: List Group (3 grid) -->
        <div class="col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>

        <!-- MAIN: Konten Dinamis (9 grid) -->
        <div class="col-md-9">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            $allowed = ['home', 'about', 'contact', 'login', 'level_list', 'level_form', 'studies_list', 'studies_form'];

            if (in_array($page, $allowed)) {
                include $page . '.php';
            } else {
                include 'home.php';
            }
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>