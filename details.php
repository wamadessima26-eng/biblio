<?php
require 'db.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM livres WHERE id = ?");
$stmt->execute([$id]);
$livre = $stmt->fetch();

if (isset($_POST['add_wishlist'])) {
    $stmt = $pdo->prepare("INSERT INTO liste_lecture (id_livre, id_lecteur, date_emprun) VALUES (?, 1, NOW())");
    $stmt->execute([$id]);
    echo "<script>alert('Ajouté à votre liste ! ');</script>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><title>Détails du Livre</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <a href="index.php" class="btn">← Retour</a>
        <?php if($livre): ?>
            <div style="display: flex; gap: 40px; margin-top: 30px; flex-wrap: wrap;">
                <img src="uploads/<?= htmlspecialchars($livre['image']) ?>" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                <div style="flex: 1; min-width: 300px;">
                    <h1><?= htmlspecialchars($livre['titre']) ?></h1>
                    <p><strong>Auteur :</strong> <?= htmlspecialchars($livre['auteur']) ?></p>
                    <p><strong>Éditeur :</strong> <?= htmlspecialchars($livre['maison_edition']) ?></p>
                    <p><strong>Catégorie :</strong> <?= htmlspecialchars($livre['categorie']) ?></p>
                    <p><strong>Description :</strong><br><?= nl2br(htmlspecialchars($livre['description'])) ?></p>
                    <p><strong>Disponibles :</strong> <?= $livre['nombre_exemplair'] ?> exemplaires </p>
                    
                    <form method="POST">
                        <button type="submit" name="add_wishlist" class="btn" style="background:#f39c12;">Ajouter à ma liste de lecture </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>