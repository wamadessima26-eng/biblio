<?php
require 'db.php';
$search = $_GET['search'] ?? '';

// Recherche par titre ou auteur
$stmt = $pdo->prepare("SELECT * FROM livres WHERE titre LIKE ? OR auteur LIKE ?");
$stmt->execute(["%$search%", "%$search%"]);
$livres = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head><title>Résultats</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Résultats pour "<?= htmlspecialchars($search) ?>"</h1>
        <a href="index.php">← Retour</a>

        <?php if(count($livres) > 0): ?>
            <?php foreach($livres as $livre): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($livre['titre']) ?></h3>
                    <p>Auteur : <?= htmlspecialchars($livre['auteur']) ?></p>
                    <a href="details.php?id=<?= $livre['id'] ?>" class="btn">Voir détails</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun livre trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>