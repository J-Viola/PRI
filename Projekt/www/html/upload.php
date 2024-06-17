<?php // Upload Playlist
require INC . '/html-begin.php';
require INC . '/nav.php';
require INC . '/tools.php';
require INC .'/boxes.php';

function xmlValidate($xmlFile, $dtdFile)
{
    libxml_use_internal_errors(true);
    $xml = new DOMDocument();
    $xml->load($xmlFile);
    $isValid = $xml->validate();
    if (!$isValid) {
        foreach (libxml_get_errors() as $error) {
            echo $error->message . "<br/>";
        }
    }
    libxml_clear_errors();
    return $isValid;
}

if (!isUser()) {
    die;
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="bg-light p-4 rounded" enctype="multipart/form-data" method="POST">
                <div class="mb-3">
                    <label for="fileInput" class="form-label">Upload Playlist:</label>
                    <input class="form-control" id="fileInput" name="xml" type="file" accept="text/xml" required>
                </div>
                <button class="btn btn-primary" type="submit">Upload</button>
            </form>
        </div>
    </div>
</div>

<?php

if (isset($_FILES['xml']) && $_FILES['xml']['tmp_name']) {
    $xmlFile = $_FILES['xml'];
    $tmpName = $xmlFile['tmp_name'];

    if (xmlValidate($tmpName, 'playlist.dtd')) {
        $playlistName = basename($xmlFile['name']);
        $target = "playlists/$playlistName";

        if (file_exists($target)) {
            errorBox('Playlist already exists.');
        } elseif (move_uploaded_file($tmpName, $target)) {
            successBox("Success - $playlistName uploaded.");
        } else {
            errorBox('Failed to upload playlist.');
        }
    } else {
        errorBox('XML file is not valid.');
    }
}

require INC . '/html-end.php';
?>

