<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: router.php?page=login");
    exit();
}

$id_utilisateur = $_SESSION['utilisateur_id'];
$message = "";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titre'], $_POST['annee'], $_POST['temps'], $_POST['type'])) {
    $titre = trim($_POST['titre']);
    $annee = trim($_POST['annee']);
    $temps = trim($_POST['temps']);
    $type = trim($_POST['type']); 
    $pays = trim($_POST['pays']) ;
    $affiche = $_POST['affiche'] ;
    $description = $_POST['description'];

    // verif si existe déjà
    $stmt = $db->prepare("SELECT Id FROM Oeuvre WHERE Titre = ? AND Annee = ? AND TypeOeuvre = ?");
    $stmt->execute([$titre, $annee, $type]);
    $oeuvre = $stmt->fetch();

    if ($oeuvre) {
        $id_oeuvre = $oeuvre['Id'];
    } 
    else {
        
        $insert = $db->prepare("INSERT INTO Oeuvre (Titre, Annee, Temps, Description, Affiche, TypeOeuvre, Pays)
                                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert->execute([$titre, $annee, $temps, $description, $affiche, $type, $pays]); 

        $id_oeuvre = $db->lastInsertId();
    }

    // verif si déjà favoris
    $verif = $db->prepare("SELECT * FROM Utilisateur_Favori WHERE IdUtilisateur = ? AND IdOeuvre = ?");
    $verif->execute([$id_utilisateur, $id_oeuvre]);

    if ($verif->fetch()) {
        
        $suppr = $db->prepare("DELETE FROM Utilisateur_Favori WHERE IdUtilisateur = ? AND IdOeuvre = ?");
        $suppr->execute([$id_utilisateur, $id_oeuvre]);
        $message = "Oeuvre retirée des favoris.";
    } 
    else {
        $ajout = $db->prepare("INSERT INTO Utilisateur_Favori (IdUtilisateur, IdOeuvre) VALUES (?, ?)");
        $ajout->execute([$id_utilisateur, $id_oeuvre]);
        $message = "Oeuvre ajoutée aux favoris.";
    }
}

// recup favoris
$stmt = $db->prepare("
    SELECT Oeuvre.*
    FROM Utilisateur_Favori
    JOIN Oeuvre ON Oeuvre.Id = Utilisateur_Favori.IdOeuvre
    WHERE Utilisateur_Favori.IdUtilisateur = ?
");
$stmt->execute([$id_utilisateur]);
$favoris = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes Favoris</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="page-favoris">
  <h2 style="text-align:center;">Mes favoris</h2>

  <?php if (!empty($message)) echo "<p style='color:green; text-align:center;'>$message</p>"; ?>

  <?php if (count($favoris) > 0): ?>
    <?php foreach ($favoris as $oeuvre): ?>
      <div class="favori-item">
        <h3><?= htmlspecialchars($oeuvre['Titre']) ?></h3>
        <p><?= htmlspecialchars($oeuvre['Annee']) ?> - <?= htmlspecialchars($oeuvre['Temps']) ?> - <?= htmlspecialchars($oeuvre['TypeOeuvre']) ?></p>
        <form method="post" action="router.php?page=favoris">
          <input type="hidden" name="titre" value="<?= htmlspecialchars($oeuvre['Titre']) ?>">
          <input type="hidden" name="annee" value="<?= htmlspecialchars($oeuvre['Annee']) ?>">
          <input type="hidden" name="temps" value="<?= htmlspecialchars($oeuvre['Temps']) ?>">
          <input type="hidden" name="type" value="<?= htmlspecialchars($oeuvre['TypeOeuvre']) ?>">
          <input type="hidden" name="pays" value="<?= htmlspecialchars($oeuvre['Pays']) ?>">
          <input type="hidden" name="affiche" value="<?= htmlspecialchars($oeuvre['Affiche']) ?>">
          <input type="hidden" name="description" value="<?= htmlspecialchars($oeuvre['Description']) ?>">
          <button type="submit">Retirer</button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align:center;">Vous n'avez pas encore de favoris.</p>
  <?php endif; ?>

  <a class="retour-accueil" href="router.php?page=public">Accueil</a>
</body>
</html>
