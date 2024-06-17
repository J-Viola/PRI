<?php // vypsat playlisty:
require '../prolog.php';
require INC . '/html-begin.php';
require INC . '/navbar.php';
require INC . '/tools.php';
require INC . '/db.php';
?>

<h1 class="py-4 text-center display-4">Playlisty</h1>

<div class="bg-light py-3">
    <div class="container">
        <ol class="fa-ul">
            <?php foreach (xmlFileList(PLAYLISTS) as $basename) { ?>
                <li class="mb-2">
                    <i class="fa fa-li fa-music"></i>
                    <a class="text-decoration-none" href="?playlist=<?= $basename ?>">
                        <?= $basename ?> (<?= precteno($basename) ?>)
                    </a>
                </li>
            <?php } ?>
        </ol>
    </div>
</div>

<section class="container mt-4">
    <?php // zvolený playlist:
    if ($playlist = @$_GET['playlist']) {
        if (TRANSFORM_SERVER_SIDE) { ?>
            <?= xmlTransform(PLAYLISTS . "/$playlist.xml", XML . '/playlist.xsl') ?>
        <?php } else { ?>
            <h2 id="nazev" class="text-center h4 mb-4"></h2>
            <script>
                loadXML(
                    "/serve/getPlaylist.php?playlist=<?= $playlist ?>",
                    (xmlDom) => {
                        // zde je možné pracovat s DOM ...
                        document.getElementById("nazev").innerHTML =
                            xmlDom.getElementsByTagName("name")[0].textContent;
                        // ... atd.
                    });
            </script>
        <?php }
    } ?>
</section>

<?php require INC . '/html-end.php'; ?>
