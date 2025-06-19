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
    </nav>
    <div class="banner">
      <h2>Bienvenue sur Mon Ciné</h2>
      <p>Découvrez votre prochain film ou série préféré !</p>
      <?php
            echo "Aujourd'hui, nous sommes le " . date('d/m/Y') . ".";
      ?>
    </div>
  </header>

  <main>
    <input type="text" id="rechercheChamps" placeholder="Rechercher un titre..." class="recherche" />
    <div id="catalogue" class="conteneur-carre"></div>
    <div id="pagination"></div>
  </main>

  <div id="modale" class="modale hidden">
    <div class="contenu-modale">
      <button id="modaleFermee" class="close-button">Fermer</button>
      <h3 id="modaleTitre"></h3>
      <p id="modalDescription"></p>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
