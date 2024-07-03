<?php
require '../prolog.php';
require INC . '/db.php';

if (!isUser()) {
    die('You must be logged in to delete a playlist.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $playlistId = intval($_POST['id']);
    $username = getUser();

    // Check if the playlist belongs to the logged-in user
    $query = "DELETE FROM songs WHERE id = ? AND username = ?";
    $stmt = $_db_->prepare($query);
    if (!$stmt) {
        die('Failed to prepare statement: ' . $_db_->error);
    }
    $stmt->bind_param("is", $playlistId, $username);
    if ($stmt->execute()) {
        $stmt->close();
        header('Location: playlists.php');
        exit;
    } else {
        die('Failed to execute delete query: ' . $stmt->error);
    }
} else {
    die('Invalid request');
}
?>
