<?php
require 'db.php';

if (isset($_POST['creer'])) {
    $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : 'default.jpg';
    if($_FILES['image']['name']) move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);

    $sql = "INSERT INTO livres (titre, auteur, description, maison_edition, nombre_exemplair, categorie, image) VALUES (?,?,?,?,?,?,?)";
    $pdo->prepare($sql)->execute([$_POST['titre'], $_POST['auteur'], $_POST['desc'], $_POST['edition'], $_POST['stock'], $_POST['categorie'], $image]);
}

if (isset($_GET['del'])) {
    $pdo->prepare("DELETE FROM livres WHERE id=?")->execute([$_GET['del']]);
    header("Location: admin.php");
}

$livres = $pdo->query("SELECT * FROM livres ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head><title>Admin - Bibliothèque</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        [cite_start]<h1>Gestion de la Collection [cite: 52]</h1>
        <a href="index.php" class="btn">← Voir le Site</a>

        <div class="book-card" style="text-align: left; padding: 20px; margin: 20px 0;">
            [cite_start]<h3>Ajouter un nouveau livre [cite: 90]</h3>
            <form method="POST" enctype="multipart/form-data">
                [cite_start]<input type="text" name="titre" placeholder="Titre [cite: 37]" required>
                <input type="text" name="auteur" placeholder="Auteur" required>
                <input type="text" name="categorie" placeholder="Catégorie (ex: Roman, Science)">
                <textarea name="desc" placeholder="Description"></textarea>
                <input type="text" name="edition" placeholder="Maison d'édition">
                <input type="number" name="stock" placeholder="Nombre d'exemplaires">
                <label>Image de couverture :</label>
                <input type="file" name="image" accept="image/*">
                <button type="submit" name="creer" class="btn">Enregistrer le livre</button>
            </form>
        </div>

        <table>
            <tr><th>Image</th><th>Titre</th><th>Actions</th></tr>
            <?php foreach($livres as $l): ?>
            <tr>
                <td><img src="uploads/<?= $l['image'] ?>" width="50"></td>
                <td><?= htmlspecialchars($l['titre']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $l['id'] ?>" class="btn">Modifier</a>
                    [cite_start]<a href="admin.php?del=<?= $l['id'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer ce livre ? [cite: 90]')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>