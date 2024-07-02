<?php
require '../prolog.php';
require INC . '/db.php';
require INC . '/boxes.php';
require INC . '/html-begin.php';
require INC . '/navbar.php';

// Načtení playlistů z databáze
$playlists = [];
$result = dbQuery("SELECT * FROM playlists");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $playlists[] = $row;
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Seznam Playlistů</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if (count($playlists) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($playlists as $playlist): ?>
                        <li class="list-group-item">
                            <strong>Album:</strong> <?= htmlspecialchars($playlist['album']) ?><br>
                            <strong>Uživatel:</strong> <?= htmlspecialchars($playlist['username']) ?><br>
                            <strong>Počet přehrání:</strong> <?= htmlspecialchars($playlist['listened']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="alert alert-info">Žádné playlisty nebyly nalezeny.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require INC . '/html-end.php';
?>