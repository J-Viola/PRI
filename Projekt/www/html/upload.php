<?php // Upload Playlist
require '../prolog.php';
require INC . '/html-begin.php';
require INC . '/navbar.php';
require INC .'/boxes.php';
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
                xmlPrintErrors(); // Přidáno pro výpis chyb
                unlink($targetfile);
            } else {
                successBox('Soubor je validní');
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