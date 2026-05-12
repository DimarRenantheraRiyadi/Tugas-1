<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
if (!isset($_SESSION['user'])): ?>
<div class="list-group shadow-sm">
    <a href="index.php?page=home" class="list-group-item list-group-item-action <?= ($page == 'home') ? 'active' : '' ?>">🏠 Home</a>
    <a href="index.php?page=about" class="list-group-item list-group-item-action <?= ($page == 'about') ? 'active' : '' ?>">👤 About Me</a>
    <a href="index.php?page=contact" class="list-group-item list-group-item-action <?= ($page == 'contact') ? 'active' : '' ?>">📞 Contact Me</a>
    <a href="index.php?page=login" class="list-group-item list-group-item-action text-primary <?= ($page == 'login') ? 'active' : '' ?>">🔑 Login</a>
</div>
<?php else: ?>
<div class="list-group shadow-sm">
    <a href="index.php?page=home" class="list-group-item list-group-item-action <?= ($page == 'home') ? 'active' : '' ?>">🏠 Home</a>
    <a href="index.php?page=about" class="list-group-item list-group-item-action <?= ($page == 'about') ? 'active' : '' ?>">👤 About Me</a>
    <a href="index.php?page=contact" class="list-group-item list-group-item-action <?= ($page == 'contact') ? 'active' : '' ?>">📞 Contact Me</a>
    <a href="index.php?page=level_list" class="list-group-item list-group-item-action <?= ($page == 'level_list') ? 'active' : '' ?>">📚 Level</a>
    <a href="index.php?page=studies_list" class="list-group-item list-group-item-action <?= ($page == 'studies_list') ? 'active' : '' ?>">🎓 Studies</a>
</div>
<?php endif; ?>