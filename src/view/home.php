

<h2>Catalogue de Films & Séries</h2>

<input type="text" id="rechercheChamps" placeholder="Rechercher un titre..." class="recherche" />

<div id="catalogue" class="conteneur-carre"></div>
<div id="pagination"></div>

<!-- modale du film -->
<div id="modale" class="modale hidden">
  <div class="contenu-modale">
    <?php if (isset($_SESSION['utilisateur_id'])): ?>
      <form method="post" action="router.php?page=favoris" id="formulaireFavori">
        <input type="hidden" name="titre" id="champTitre" />
        <input type="hidden" name="annee" id="champAnnee" />
        <input type="hidden" name="temps" id="champTemps" />
        <input type="hidden" name="type" id="champType" />
        <input type="hidden" name="pays" id="champPays" />
        <input type="hidden" name="affiche" id="champAffiche" />
        <input type="hidden" name="description" id="champDescription" />
        <button type="submit" id="boutonFavori">Ajouter / Retirer des favoris</button>
      </form>
    <?php endif; ?>

    <button id="modaleFermee" class="close-button">Fermer</button>
    <h3 id="modaleTitre"></h3>
    <p id="modalDescription"></p>
  </div>
</div>

<script src="assets/js/script.js"></script>
