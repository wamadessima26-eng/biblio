<?php
require 'db.php';
$id = $_GET['id'];

// Mise à jour
if (isset($_POST['update'])) {
    $sql = "UPDATE livres SET titre=?, auteur=?, description=?, maison_edition=?, nombre_exemplair=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['titre'], $_POST['auteur'], $_POST['desc'], $_POST['edition'], $_POST['stock'], $id]);
    header("Location: admin.php");
}

// Récupérer infos actuelles
$stmt = $pdo->prepare("SELECT * FROM livres WHERE id=?");
$stmt->execute([$id]);
$livre = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head><title>Modifier</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Modifier le livre</h1>
        <form method="POST">
            <label>Titre</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>
            
            <label>Auteur</label>
            <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required>
            
            <label>Description</label>
            <textarea name="desc"><?= htmlspecialchars($livre['description']) ?></textarea>
            
            <label>Maison d'édition</label>
            <input type="text" name="edition" value="<?= htmlspecialchars($livre['maison_edition']) ?>">
            
            <label>Nombre d'exemplaires</label>
            <input type="number" name="stock" value="<?= $livre['nombre_exemplair'] ?>">
            
            <button type="submit" name="update" class="btn">Enregistrer les modifications</button>
        </form>
    </div>
</body>
</html>