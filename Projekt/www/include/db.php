<?php
// --- databázové funkce ---

// globální objekt - připojí databázi - vitální!
$_db_ = mysqli_connect("database", "admin", "heslo", "playlists") or die;

// dotaz k databázi
function dbQuery(string $query): bool|mysqli_result
{
    global $_db_;
    return @$_db_->query($query);
}

function dbEscape(string $s): string
{
    global $_db_;
    return "'" . mysqli_real_escape_string($_db_, $s) . "'";
}

// ověření uživatele
function authUser(string $username, string $password): bool
{
    $username = dbEscape($username);
    $password = dbEscape($password);

    if ($result = dbQuery("SELECT id FROM users WHERE username=$username AND password=$password")) {
        if ($result->num_rows) {
            // fetch_all() vrací pole polí (řádky, a každá má políčka)
            // [[$id]] je dekonstrukce: vezme první hodnotu z první řádky
            [[$id]] = $result->fetch_all();
            if ($id)
                return true;
        }
    }

    return false;
}

// popularita
function precteno(string $playlist): int
{
    $playlist = dbEscape($playlist);

    dbQuery("insert into playlists (nazev, prehrano) value($playlist, 1) on duplicate key update playlist = prehrano+1");
    $result = dbQuery("select prehrano from playlists where nazev=$playlist");
    // opět dekonstrukce
    [[$prehrano]] = $result->fetch_all();
    return $prehrano;
}
