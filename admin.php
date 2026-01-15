<?php
require 'db.php';

// Créer un livre (CREATE)
if (isset($_POST['creer'])) {
    $sql = "INSERT INTO livres (titre, auteur, description, maison_edition, nombre_exemplair) VALUES (?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['titre'], $_POST['auteur'], $_POST['desc'], $_POST['edition'], $_POST['stock']]);
}

// Supprimer un livre (DELETE)
if (isset($_GET['del'])) {
    $pdo->prepare("DELETE FROM livres WHERE id=?")->execute([$_GET['del']]);
    header("Location: admin.php");
}

// Lire tous les livres (READ)
$livres = $pdo->query("SELECT * FROM livres")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head><title>Admin</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Gestion Bibliothèque (CRUD)</h1>
        <a href="index.php">← Retour site</a>

        <div class="card">
            <h3>Ajouter un livre</h3>
            <form method="POST">
                <input type="text" name="titre" placeholder="Titre" required>
                <input type="text" name="auteur" placeholder="Auteur" required>
                <textarea name="desc" placeholder="Description"></textarea>
                <input type="text" name="edition" placeholder="Maison d'édition">
                <input type="number" name="stock" placeholder="Nombre exemplaires">
                <button type="submit" name="creer" class="btn">Ajouter</button>
            </form>
        </div>

        <table>
            <tr><th>ID</th><th>Titre</th><th>Actions</th></tr>
            <?php foreach($livres as $l): ?>
            <tr>
                <td><?= $l['id'] ?></td>
                <td><?= htmlspecialchars($l['titre']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $l['id'] ?>" class="btn">Modifier</a>
                    <a href="admin.php?del=<?= $l['id'] ?>" class="btn btn-danger" onclick="return confirm('Sûr ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>