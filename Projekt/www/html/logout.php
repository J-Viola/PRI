<?php
require '../prolog.php';
require INC . '/boxes.php';
require INC . '/html-begin.php';
require INC . '/navbar.php';
session_unset();
session_destroy();
successBox('Úspěšné odhlášení.');
echo '<script>
        setTimeout(function() {
            window.location.href = "/index.php";
        }, 2000); // Přesměrování po 2 sekundách
      </script>';
exit();
require INC . '/html-end.php';