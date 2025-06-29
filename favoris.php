<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: login.php");
    exit();
}

$id_utilisateur = $_SESSION['utilisateur_id'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_oeuvre'])) {
    $id_oeuvre = $_POST['id_oeuvre'];

    $verif = $db->prepare("SELECT * FROM Utilisateur_Favori WHERE IdUtilisateur = ? AND IdOeuvre = ?");
    $verif->execute([$id_utilisateur, $id_oeuvre]);

    if ($verif->fetch()) {
        $suppr = $db->prepare("DELETE FROM Utilisateur_Favori WHERE IdUtilisateur = ? AND IdOeuvre = ?");
        $suppr->execute([$id_utilisateur, $id_oeuvre]);
        $message = "Œuvre retirée des favoris.";
    } else {
        $ajout = $db->prepare("INSERT INTO Utilisateur_Favori (IdUtilisateur, IdOeuvre) VALUES (?, ?)");
        $ajout->execute([$id_utilisateur, $id_oeuvre]);
        $message = "Œuvre ajoutée aux favoris.";
    }
}

$requete = $db->prepare("
    SELECT Oeuvre.*
    FROM Oeuvre
    JOIN Utilisateur_Favori ON Oeuvre.Id = Utilisateur_Favori.IdOeuvre
    WHERE Utilisateur_Favori.IdUtilisateur = ?
");
$requete->execute([$id_utilisateur]);
$liste_favoris = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes Favoris</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="page-favoris">

  <h2 style="text-align:center;">Mes favoris</h2>

  <?php if (!empty($message)) echo "<p style='color:green; text-align:center;'>$message</p>"; ?>

  <?php if (count($liste_favoris) > 0): ?>
    <?php foreach ($liste_favoris as $oeuvre): ?>
      <div class="favori-item">
        <h3><?= htmlspecialchars($oeuvre['Titre']) ?></h3>
        <p><?= htmlspecialchars($oeuvre['Annee']) ?> - <?= htmlspecialchars($oeuvre['Type']) ?></p>
        <form method="post" action="favoris.php">
          <input type="hidden" name="id_oeuvre" value="<?= $oeuvre['Id'] ?>">
          <button type="submit">Supprimer</button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align:center;">Vous n'avez pas encore de favoris.</p>
  <?php endif; ?>

  <a class="retour-accueil" href="index.php">Accueil</a>
</body>
</html>
