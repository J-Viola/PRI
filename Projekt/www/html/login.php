<?php // přihlášení uživatele
require '../prolog.php';
require INC . '/db.php';
require INC . '/html-begin.php';

switch (@$_POST['akce']) {
    case 'login':
        if (authUser($username = $_POST['jmeno'], $_POST['heslo']))
            setUser($username);  // Corrected from setJmeno to setUser
        break;

    case 'logout':
        setUser();
        break;
}

// nav až po nastavení jména, aby se zobrazilo
require INC . '/navbar.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form name="loginForm" class="bg-light p-4 rounded shadow-sm" method="POST">
                <input type="hidden" name="akce" value="<?= isUser() ? 'logout' : 'login' ?>">
                <?php if (!isUser()) { ?>
                    <div class="mb-3">
                        <label for="jmeno" class="form-label">Jméno:</label>
                        <input class="<?= $inputClass ?>" id="jmeno" name="jmeno" type="text" placeholder="Jméno" required>
                    </div>
                    <div class="mb-3">
                        <label for="heslo" class="form-label">Heslo:</label>
                        <input class="<?= $inputClass ?>" id="heslo" name="heslo" type="password" placeholder="Heslo" required>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary w-100"><?= isUser() ? 'Odhlásit' : 'Přihlásit' ?></button>
            </form>
        </div>
    </div>
</div>

<script>
    document.loginForm.addEventListener('submit', onSubmit)
</script>

<?php require INC . '/html-end.php'; ?>
