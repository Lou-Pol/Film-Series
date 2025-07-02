Tests unitaires 


- test_searchMovie_renvoie_film() :

  Contenu: Vérifier que la méthode searchMovie (méthode que je veux dans le traitement de l'api en php) retourne bien les résultats attendus pour une recherche de film donnée.


- test_details_obtenus_correctement() :

  Contenu : Tester que les détails du film sont récupérés correctement par la méthode getMovieDetails() (fait si api en php fait).


- test_detection_favoris() :
 
  Contenu : Vérifier si la méthode isFavoris() (fait si api en php fait) retourne correctement `true` ou `false` en fonction de si le film est dans les favoris de l'utilisateur.

- test_ajout_favoris :

  Contenu : Tester que le film est bien ajouté aux favoris dans la base de données par addFavorite() (fait si api en php fait).

- test_retirer_favoris :

  Contenu : Tester que le film est bien retiré des favoris par removeFavorite() (fait si api en php fait).



Tests d'intégration 

- test_recherche_et_details_recuperes :

  Contenu : Vérifier que lorsqu'un film est sélectionné depuis la recherche, ses détails sont correctement récupérés.
  
- test_ajout_et_affichage_favoris_correspondent :

  Contenu : Tester que l'ajout d'un film aux favoris est bien dans la liste des films favoris de l'utilisateur.



Tests fonctionnels 

- test_recherche_vaut_resultat :

  Contenu : Vérifier que l'utilisateur peut effectuer une recherche de films et voir les résultats qui vont avec.

- test_ajout_favoris_UI :

  Contenu : Vérifier que l'utilisateur peut ajouter un film aux favoris en cliquant sur le bouton "Ajouter/Retirer aux favoris".

- test_retirer_favoris_UI :

  Contenu : Vérifier que l'utilisateur peut retirer un film de ses favoris en cliquant sur le bouton "Ajouter/Retirer aux favoris".

- test_retirer_favoris_liste_UI : 

  Contenu : Vérifier que l'utilisateur peut enlever un film de sa liste via l'affichage des favoris 


