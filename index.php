<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque D-CLIC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenue à la Bibliothèque</h1>
        <p>Recherchez, consultez et gérez vos livres préférés.</p>
        
        <div style="margin-bottom: 20px;">
            <a href="wishlist.php" class="btn btn-nav">Ma Liste de Lecture</a>
            <a href="admin.php" class="btn btn-nav">Espace Admin (CRUD)</a>
        </div>

        <div class="card">
            <h2>Rechercher un livre</h2>
            <form action="results.php" method="GET">
                <input type="text" name="search" placeholder="Titre ou Auteur..." required>
                <button type="submit" class="btn">Rechercher</button>
            </form>
        </div>
    </div>
</body>
</html>