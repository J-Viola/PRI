<?php
require '../prolog.php';
require INC . '/db.php';
require INC . '/boxes.php';
require INC . '/html-begin.php';
require INC . '/navbar.php';

// Načtení playlistů z databáze
$playlists = [];
$result = dbQuery("SELECT * FROM songs");
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
                            <strong>Název Playlistu:</strong> <?= htmlspecialchars($playlist['playlist_name'] ?? '') ?><br>
                            <strong>Délka:</strong> <?= htmlspecialchars($playlist['length'] ?? '') ?><br>
                            <strong>Alba:</strong> 
                            <?php
                            $albums = explode("; ", $playlist['albums'] ?? '');
                            foreach ($albums as $album) {
                                $albumName = explode(": ", $album)[0];
                                echo htmlspecialchars($albumName) . ", ";
                            }
                            ?><br>
                            <strong>Písně:</strong> <?= htmlspecialchars($playlist['songs'] ?? '') ?><br>
                            <strong>Uživatel:</strong> <?= htmlspecialchars($playlist['username'] ?? '') ?><br>
                            <strong>Favorited:</strong> <span id="favorited-<?= $playlist['id'] ?>"><?= htmlspecialchars($playlist['favorited'] ?? '') ?></span><br>
                            <form action="like.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $playlist['id'] ?>">
                                <button type="submit" class="btn btn-primary">Like</button>
                            </form>
                            <?php if (isUser() && getUser() === $playlist['username']): ?>
                                <form action="delete_playlist.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $playlist['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            <?php endif; ?>
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
