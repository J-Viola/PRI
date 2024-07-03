<?php
require '../prolog.php';
require INC . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $playlistId = intval($_POST['id']);
    $query = "UPDATE songs SET favorited = favorited + 1 WHERE id = ?";
    $stmt = $_db_->prepare($query);
    if (!$stmt) {
        die('Failed to prepare statement: ' . $_db_->error);
    }
    $stmt->bind_param("i", $playlistId);
    if ($stmt->execute()) {
        $stmt->close();
        header('Location: playlists.php');
        exit;
    } else {
        die('Failed to execute update query: ' . $stmt->error);
    }
} else {
    die('Invalid request');
}
?>