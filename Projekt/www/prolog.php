<?php
// adresáře
define('INC', __DIR__ . '/include');
define('XML', __DIR__ . '/xml');
define('PLAYLISTS', '/var/playlists/customplaylists');

// konfigurace stránek
define('TITLE', 'Favourite Playlists');

// kde transformovat XML
define('TRANSFORM_SERVER_SIDE', true);

// session
session_start();  

// jméno přihlášeného uživatele
function getUser($prefix = ''): string
{
    $name = @$_SESSION['name'];
    return $name ? "$prefix$name" : '';
}

// nastav nebo smaž jméno přihlášeného uživatele
function setUser($name = '')
{
    if ($name)
        $_SESSION['name'] = $name;
    else
        unset($_SESSION['name']);
}

// Kontrola, zda je přihlášený uživatel
function isUser(): bool
{
    return !!getUser();
}