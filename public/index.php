<?php
session_start();
require_once __DIR__ . '/../src/config/config.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Catalogue Films & Séries</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

  <header>
    <h1>Mon Ciné</h1>
    <nav>
      <a href="router.php?page=index">Accueil</a>
      <a href="#">Séries</a>
      <a href="#">Films</a>
      <a href="#">Mon Compte</a>

      <?php if (isset($_SESSION['identifiant'])): ?>
        <p>Bienvenue, <a href="router.php?page=favoris"><?= htmlspecialchars($_SESSION['identifiant']) ?></a> !</p>
        <form method="post" action="router.php?page=logout">
          <button type="submit">Se déconnecter</button>
        </form>
      <?php else: ?>
        <p><a href="router.php?page=login">Se connecter</a></p>
      <?php endif; ?>
    </nav>

    <div class="banner">
      <h2>Bienvenue sur Mon Ciné</h2>
      <p>Découvrez votre prochain film ou série préféré !</p>
    </div>
  </header>

  <main>
    <?php
      require_once __DIR__ . '/router.php';
    ?>
  </main>


</body>
</html>
