<?php
require 'db.php';
$id_lecteur = 1; // Simulation utilisateur connecté

// Suppression d'un livre de la liste
if (isset($_GET['delete'])) {
    $id_livre = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM liste_lecture WHERE id_livre = ? AND id_lecteur = ?");
    $stmt->execute([$id_livre, $id_lecteur]);
    header("Location: wishlist.php");
}

// Récupération de la liste (Jointure entre liste_lecture et livres)
$sql = "SELECT livres.*, liste_lecture.date_emprun 
        FROM livres 
        JOIN liste_lecture ON livres.id = liste_lecture.id_livre 
        WHERE liste_lecture.id_lecteur = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_lecteur]);
$mes_livres = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head><title>Ma Liste</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Ma Liste de Lecture</h1>
        <a href="index.php">← Retour accueil</a>
        
        <table>
            <tr><th>Titre</th><th>Date ajout</th><th>Action</th></tr>
            <?php foreach($mes_livres as $l): ?>
            <tr>
                <td><?= htmlspecialchars($l['titre']) ?></td>
                <td><?= $l['date_emprun'] ?></td>
                <td><a href="wishlist.php?delete=<?= $l['id'] ?>" class="btn btn-danger">Retirer</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>