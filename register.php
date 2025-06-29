<?php
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifiant = $_POST['identifiant'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if (!empty($identifiant) && !empty($mot_de_passe)) {
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        try {
            $requete = $db->prepare("INSERT INTO Utilisateur (Identifiant, MotDePasse) VALUES (?, ?)");
            $succès = $requete->execute([$identifiant, $mot_de_passe_hash]);

            if ($succès) {
                echo "Utilisateur inscrit";
            } else {
                echo "Échec de l'inscription.";
            }
        } catch (PDOException $erreur) {
            echo "Erreur PDO : " . $erreur->getMessage();
        }
    } else {
        echo "Les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="page-formulaire">

  <div class="formulaire-container">
    <h2>Créer un compte</h2>
    <form method="post" action="register.php">
      <input type="text" name="identifiant" placeholder="Identifiant" required>
      <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
      <input type="submit" value="S'inscrire">
    </form>
    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
  </div>

</body>
</html>