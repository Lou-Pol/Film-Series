<?php
require_once 'database.php'; // Assuming your DB connection is in this file

/*
// Uncomment to test creating a user statically on page load
try {
    $stmt = $db->prepare("INSERT INTO Utilisateur (username, email, password) VALUES (?, ?, ?)");
    $success = $stmt->execute(['testuser', 'test@example.com', password_hash('testpass', PASSWORD_DEFAULT)]);
    if ($success) {
        echo "Utilisateur ajouté avec succès (test statique).";
    } else {
        echo "Échec de l'insertion test.";
    }
} catch (PDOException $e) {
    echo "Erreur PDO (test) : " . $e->getMessage();
}
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($email) && !empty($password)) 
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $db->prepare("INSERT INTO Utilisateur (username, email, password) VALUES (?, ?, ?)");
            $success = $stmt->execute([$username, $email, $hashedPassword]);

            if ($success) {
                echo "Utilisateur inscrit avec succès.";
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Erreur lors de l'inscription (échec de l'exécution) : " . implode(" | ", $errorInfo);
            }
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
    } else {
        echo "Tous les champs sont requis.";
    }
}

/*
// Debug: display list of users
echo "<h2>Utilisateurs enregistrés :</h2>";
foreach ($db->query("SELECT id, username, email FROM Utilisateur") as $row) {
    echo "ID: {$row['id']} | Username: {$row['username']} | Email: {$row['email']}<br>";
}
*/
?>
