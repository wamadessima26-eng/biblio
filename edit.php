<?php
require 'db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM livres WHERE id=?");
$stmt->execute([$id]);
$livre = $stmt->fetch();

if (isset($_POST['update'])) {
    $image = $livre['image'];
    if($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);
    }

    $sql = "UPDATE livres SET titre=?, auteur=?, description=?, maison_edition=?, nombre_exemplair=?, categorie=?, image=? WHERE id=?";
    $pdo->prepare($sql)->execute([$_POST['titre'], $_POST['auteur'], $_POST['desc'], $_POST['edition'], $_POST['stock'], $_POST['categorie'], $image, $id]);
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><title>Modifier</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Modifier : <?= htmlspecialchars($livre['titre']) ?></h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>
            <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required>
            <input type="text" name="categorie" value="<?= htmlspecialchars($livre['categorie']) ?>">
            <textarea name="desc"><?= htmlspecialchars($livre['description']) ?></textarea>
            <input type="text" name="edition" value="<?= htmlspecialchars($livre['maison_edition']) ?>">
            <input type="number" name="stock" value="<?= $livre['nombre_exemplair'] ?>">
            <p>Image actuelle : <?= $livre['image'] ?></p>
            <input type="file" name="image" accept="image/*">
            <button type="submit" name="update" class="btn">Mettre à jour </button>
        </form>
    </div>
</body>
</html>