<?php
// pro zobrazení chyby
function errorBox($text)
{ ?>
    <div class="alert alert-danger m-4 p-4 rounded">
        <?= $text ?>
    </div>
<?php }

// pro zobrazení úspěchu
function successBox($text)
{ ?>
    <div class="alert alert-success m-4 p-4 rounded">
        <?= $text ?>
    </div>
<?php }
?>