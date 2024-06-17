<?php
// seznam stránek (href => title)
$pages = [
    '/' => 'Home',
    '/login.php' => 'Přihlášení',
    '/playlists.php' => 'Playlisty',
];

// přihlášený uživatel smí nahrávat recepty
if (isUser())
    $pages['/upload.php'] = 'Nahrát';
