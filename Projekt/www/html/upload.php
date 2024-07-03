<?php // Upload Playlist
require '../prolog.php';
require INC . '/html-begin.php';
require INC . '/navbar.php';
require INC .'/boxes.php';
require INC .'/db.php'; // Ensure the database connection is included
?>

<?php
  if (!isUser()){
    echo "<script>setTimeout(function() 
    { window.location.href = '/index.php'; }, 1000);</script>";
    exit;
}
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Nahrát XML Soubor</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="xmlFile" class="form-label">Vyberte XML soubor k nahrání:</label>
                        <input type="file" class="form-control" name="xmlFile" id="xmlFile" accept=".xml">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Nahrát</button>
                </form>
            </div>
        </div>
</div>

<?php
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_FILES['xmlFile']) && $_FILES['xmlFile']['error'] === UPLOAD_ERR_OK) {
            $targetdir = XML . '/upload/';
            $targetfile = $targetdir . basename($_FILES['xmlFile']['name']);
            move_uploaded_file($_FILES['xmlFile']['tmp_name'], $targetfile);
            echo "Soubor byl spěšně nahrán.";
            $dom = new DOMDocument();
            libxml_use_internal_errors(true); // Enable user error handling
            $dom->load($targetfile);
            $scheme = XML . '/playlist.xsd';
            if (!@$dom->schemaValidate($scheme)) {
                errorBox('Soubor není validní.');
                unlink($targetfile);
            } else {
                successBox('Soubor je validní');
                
                // Extract properties from XML
                $playlistName = $dom->getElementsByTagName('name')->item(0)->nodeValue;
                $totalLength = $dom->getElementsByTagName('totallength')->item(0)->nodeValue;
                $albums = [];
                $allSongs = [];
                foreach ($dom->getElementsByTagName('album') as $album) {
                    $albumName = $album->getAttribute('name');
                    $songs = [];
                    foreach ($album->getElementsByTagName('song') as $song) {
                        $songs[] = $song->nodeValue;
                        $allSongs[] = $song->nodeValue;
                    }
                    $albums[] = $albumName . ": " . implode(", ", $songs);
                }
                $username = getUser();
                
                // Insert into database
                global $_db_; // Use the global keyword to access the global variable
                $albumsStr = implode("; ", $albums);
                $allSongsStr = implode(", ", $allSongs);
                $query = "INSERT INTO songs (playlist_name, length, albums, songs, username, favorited) VALUES (?, ?, ?, ?, ?, 0)";
                $stmt = $_db_->prepare($query);
                $stmt->bind_param("sssss", $playlistName, $totalLength, $albumsStr, $allSongsStr, $username);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            echo "Nahrání souboru selhalo.";
        }
        break;
    
    default:
        break;
}
libxml_clear_errors();
?>

<?php
require INC . '/html-end.php';
?>