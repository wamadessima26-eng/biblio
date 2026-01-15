<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bibliothèque D-CLIC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📚 Bibliothèque en Ligne</h1>
        <p>Bienvenue ! [cite_start]Cliquez sur une couverture pour voir les détails ou utilisez la barre de recherche. [cite: 58]</p>
        
        <div style="margin-bottom: 30px;">
            <a href="wishlist.php" class="btn btn-nav">Ma Liste de Lecture</a>
            <a href="admin.php" class="btn btn-nav" style="background:#8e44ad;">Administration</a>
        </div>

        <form action="results.php" method="GET" style="margin-bottom: 40px;">
            [cite_start]<input type="text" name="search" placeholder="Rechercher par titre ou auteur... [cite: 59]" required>
            <button type="submit" class="btn">Rechercher</button>
        </form>

        <?php
        $cat_query = $pdo->query("SELECT DISTINCT categorie FROM livres");
        $categories = $cat_query->fetchAll(PDO::FETCH_COLUMN);

        foreach($categories as $cat): ?>
            <div class="category-section">
                <h2>Genre : <?= htmlspecialchars($cat) ?></h2>
                <div class="book-grid">
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM livres WHERE categorie = ?");
                    $stmt->execute([$cat]);
                    while($l = $stmt->fetch()): ?>
                        <div class="book-card">
                            <a href="details.php?id=<?= $l['id'] ?>">
                                <img src="uploads/<?= htmlspecialchars($l['image']) ?>" alt="Couverture">
                            </a>
                            <p><strong><?= htmlspecialchars($l['titre']) ?></strong></p>
                            <p><small><?= htmlspecialchars($l['auteur']) ?></small></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>