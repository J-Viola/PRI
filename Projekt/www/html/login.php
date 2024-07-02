<?php
require '../prolog.php';
require INC . '/db.php';
require INC . '/boxes.php';
require INC . '/html-begin.php';
require INC . '/navbar.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authUser($username, $password)) {
        setUser($username);
        successBox('Úspěšné přihlášení.');
        echo '<script>
                setTimeout(function() {
                    window.location.href = "/index.php";
                }, 2000); // Přesměrování po 2 sekundách
              </script>';
        exit;
    } else {
        errorBox('Nesprávné jméno nebo heslo.');
    }
}
?>

<div class="container mt-5">
<h2 class="mb-4 text-center">Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
        <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>            </form>
        </div>
    </div>
</div>


<?php require INC . '/html-end.php'; ?>
