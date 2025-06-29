<?php
session_start();
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifiant = $_POST['identifiant'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if (!empty($identifiant) && !empty($mot_de_passe)) {
        $requete = $db->prepare("SELECT * FROM Utilisateur WHERE Identifiant = ?");
        $requete->execute([$identifiant]);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['MotDePasse'])) {
            $_SESSION['utilisateur_id'] = $utilisateur['Id'];
            $_SESSION['identifiant'] = $utilisateur['Identifiant'];
            header("Location: index.php");
            exit();
        } else {
            $erreur = "Identifiant ou mot de passe incorrect.";
        }
    } else {
        $erreur = "Les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="page-formulaire">

  <div class="formulaire-container">
    <h2>Se connecter</h2>
    <?php if (!empty($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>
    <form method="post" action="login.php">
      <input type="text" name="identifiant" placeholder="Identifiant" required>
      <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
      <input type="submit" value="Connexion">
    </form>
    <p>Pas de compte ? <a href="register.php">Créer un compte</a></p>
  </div>

</body>
</html>
