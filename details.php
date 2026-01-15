<?php
require 'db.php';

// Récupération du livre
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM livres WHERE id = ?");
    $stmt->execute([$id]);
    $livre = $stmt->fetch();
}

// Logique d'ajout à la liste de lecture
if (isset($_POST['add_wishlist'])) {
    $id_livre = $_POST['id_livre'];
    $id_lecteur = 1; // ID fixe car pas de système de connexion complet demandé
    $date = date('Y-m-d');
    
    // Insertion dans la table liste_lecture [cite: 50]
    $sql = "INSERT INTO liste_lecture (id_livre, id_lecteur, date_emprun) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_livre, $id_lecteur, $date]);
    echo "<script>alert('Livre ajouté à votre liste !');</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head><title>Détails</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <a href="index.php">← Retour accueil</a>
        
        <?php if($livre): ?>
            <h1><?= htmlspecialchars($livre['titre']) ?></h1>
            <p><strong>Auteur :</strong> <?= htmlspecialchars($livre['auteur']) ?></p>
            <p><strong>Éditeur :</strong> <?= htmlspecialchars($livre['maison_edition']) ?></p>
            <p><strong>Description :</strong> <?= htmlspecialchars($livre['description']) ?></p>
            <p><strong>Exemplaires :</strong> <?= $livre['nombre_exemplair'] ?></p>

            <form method="POST">
                <input type="hidden" name="id_livre" value="<?= $livre['id'] ?>">
                <button type="submit" name="add_wishlist" class="btn">Ajouter à ma liste de lecture</button>
            </form>
        <?php else: ?>
            <p>Livre introuvable.</p>
        <?php endif; ?>
    </div>
</body>
</html>