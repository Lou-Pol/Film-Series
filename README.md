Documentation technique 

1/ Présentation rapide

- Nom de l’application  : Catalogue de Films & Séries
  Objectif : Cette application permet à un utilisateur de rechercher des films ou des séries, d'afficher les détails d'un film, d'ajouter des films à ses favoris, et de les retirer.


- Fonctionnalités principales :

   Recherche de films via l'API OMDB.
   Affichage des détails d'un film sélectionné.
   Gestion des favoris (ajout/suppression de films favoris).
   Interface utilisateur réactive qui met à jour l'affichage des films favoris.

- Technologies utilisées :

   Frontend : PHP (pour l'interaction côté serveur).
   Backend : PHP avec utilisation de l'API OMDB pour la recherche de films (dans ce cas le coté API n'est pas encore géré en php mais en js).
   Base de données : SQLLite pour stocker les films favoris des utilisateurs.

- Arborescence du projet

/public
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/assets 			
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/css
	   <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;style.css
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/js
	   <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;script.js
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;index.php
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;router.php
<br>/src
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/config
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/sql
	   <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diagramme_Uml.png
	   <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Films_Series.db
	   <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Script.sql
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;config.php
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;database.php
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/sevices
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/view
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;favoris.php
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;home.php 
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;login.php
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;logout.php
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;register.php
    
2/ Installation

- Prérequis  :
     PHP 7.4 ou supérieur.
     Accès à une base de données SQLLite.
     OMDb API clé API 

- Instructions pour lancer le projet en local :

     Clonez le dépôt.
     Configurez la connexion à la base de données dans `src/config/database.php`.
     Installez les dépendances avec Composer (si nécessaire).
     Lancez un serveur local en exécutant la commande : php -S localhost:8080 -t ./public

- Instructions pour faire le fichier .env :

    Crée un fichier .env dans la racine du projet avec les informations suivantes :

     DB_PATH=<PATH de .db> 
     OMDB_API_KEY=<API_KEY>

3/ Base de données

Schéma de la base de données
		--> Une table Utilisateur avec Id, identifiant et motdepasse
		--> Une table Personne avec Id, Nom, Prenom
		--> Une table Langue avec Id, NomLangue 
		--> Une table Genre avec Id, NomGenre 
		--> Une table Appreciation avec Id, IdUtil de la table Utilisateur, Commentaire, Note
		--> Une table Oeuvre avec Id, Titre, Annee, Temps, Description, Affiche, TypeOeuvre, Pays 
		--> Une table Oeuvre_Genre avec IdOeuvre de la table Oeuvre, IdGenre de la table Genre
		--> Une table Oeuvre_Langue avec IdOeuvre de la table Oeuvre, IdLangue de la table Langue
		--> Une table Oeuvre_Personne avec IdOeuvre de la table Oeuvre, IdPersonne de la table Personne
		--> Une table Oeuvre_Appreciation avec IdOeuvre de la table Oeuvre, IdAppreciation de la table Appreciation
		--> Une table Utilisateur_Favori avec IdOeuvre de la table Oeuvre, IdUtilisateur de la table Utilisateur

4/ Flux de données

- Exemple d'un appel à OMDB 

  $omdbService = new OMDBService();
  $result = $omdbService->searchMovie('Inception');

- Exemple d'un appel avec la base de données 

  $dbService = new DatabaseService();
  $favorites = $dbService->getFavorites($userId);


5/ Évolutivité
  Ajouter un système de filtre pour des recherches plus poussés de films.
  Mieux gérer le système de pagination 
