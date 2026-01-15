<?php
require 'db.php';
$id_lecteur = 1;

if (isset($_GET['remove'])) {
    $pdo->prepare("DELETE FROM liste_lecture WHERE id_livre = ? AND id_lecteur = ?")->execute([$_GET['remove'], $id_lecteur]);
    header("Location: wishlist.php");
}

$sql = "SELECT livres.* FROM livres JOIN liste_lecture ON livres.id = liste_lecture.id_livre WHERE liste_lecture.id_lecteur = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_lecteur]);
$wishlist = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head><title>Ma Liste</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        [cite_start]<h1>Ma Liste de Lecture [cite: 78]</h1>
        <a href="index.php" class="btn">← Retour</a>
        <div class="book-grid" style="margin-top:20px;">
            <?php foreach($wishlist as $l): ?>
                <div class="book-card">
                    <img src="uploads/<?= $l['image'] ?>">
                    <p><strong><?= htmlspecialchars($l['titre']) ?></strong></p>
                    [cite_start]<a href="wishlist.php?remove=<?= $l['id'] ?>" class="btn btn-danger">Retirer [cite: 80]</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>