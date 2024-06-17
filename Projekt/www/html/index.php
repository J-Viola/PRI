<?php // úvodní stránka:
require '../prolog.php';
require INC . '/html-begin.php';
require INC . '/navbar.php';
?>

<style>
  p {
    margin-bottom: 1em;
  }
</style>

<main class="container mt-5 pb-5">
  <h1 class="text-center mb-5">
    <?= TITLE ?>
  </h1>

  <p>
    Hudební svět se dělí na dva tábory. Jedni vám v roztrhaných džínách a ušmudlaném tričku 
    zahrají na kytaru v garáži za pár piv, jiní vám ve vyžehleném obleku a s pěstovaným knírkem 
    sestaví pečlivě vybraný playlist za stovky korun. Ten druhý typ hudebníků nazýváme kurátoři, 
    praktikanty oboru kurátorství, což je odborný termín pro tvorbu opravdu dobrých playlistů.
  </p>

  <div>
    <?= file_get_contents('http://loripsum.net/api/12/medium'); ?>
  </div>
</main>

<?php require INC . '/html-end.php'; ?>
