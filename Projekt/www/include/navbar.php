<?php // navbar – navigační lišta
require INC . '/pages.php';
?>

<!-- top navigation bar -->
<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top shadow-md">
    <div class="container-fluid">
        <!-- logo & title -->
        <a class="navbar-brand" href='/'>
            <div class="d-flex align-items-center">
                <img src="./assets/drink.jpg" class="h-8 mr-3" alt="Logo"/>
                <span class="text-2xl font-semibold">
                    <?= TITLE . getUser(': ') ?>
                </span>
            </div>
        </a>

        <!-- hamburger menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- menu items -->
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                <?php foreach ($pages as $href => $title) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-blue-700" href="<?= $href ?>">
                            <?= $title ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let menu = document.getElementById('navbarMenu');
        let button = document.getElementById('menu-toggle');
        if (button) {
            button.addEventListener('click', () => {
                menu.classList.toggle('show');
            });
        }
    });
</script>
