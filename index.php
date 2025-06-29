<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Catalogue Films & Séries</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1>Mon Ciné</h1>
    <nav>
      <a href="#">Accueil</a>
      <a href="#">Séries</a>
      <a href="#">Films</a>
      <a href="#">Mon Compte</a>

      <?php if (isset($_SESSION['identifiant'])): ?>
        <p>Bienvenue, <a href="favoris.php"><?= htmlspecialchars($_SESSION['identifiant']) ?></a> !</p>
        <form method="post" action="logout.php">
          <button type="submit">Se déconnecter</button>
        </form>
      <?php else: ?>
        <p><a href="login.php">Se connecter</a></p>
      <?php endif; ?>
    </nav>

    <div class="banner">
      <h2>Bienvenue sur Mon Ciné</h2>
      <p>Découvrez votre prochain film ou série préféré !</p>
    </div>
  </header>

  <main>
    <input type="text" id="rechercheChamps" placeholder="Rechercher un titre..." class="recherche" />
    <div id="catalogue" class="conteneur-carre"></div>
    <div id="pagination"></div>
  </main>

  <!-- Modale -->
  <div id="modale" class="modale hidden">
    <div class="contenu-modale">

      <?php if (isset($_SESSION['utilisateur_id'])): ?>
        <form method="post" action="favoris.php" id="formulaireFavori">
          <input type="hidden" name="id_oeuvre" id="champOeuvreId" />
          <button type="submit" id="boutonFavori">Ajouter / Retirer des favoris</button>
        </form>
      <?php endif; ?>

      <button id="modaleFermee" class="close-button">Fermer</button>
      <h3 id="modaleTitre"></h3>
      <p id="modalDescription"></p>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
