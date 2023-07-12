

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;1,100;1,400&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout produit</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="menu">
        <a href="recap.php">Voir le tableau recapitulatif</a>
        <?php 
    session_start();
    if(isset($_SESSION["errors"]) && !empty($_SESSION["errors"])){
    echo "<h2 class='nb_produit'>".count($_SESSION["products"])." Produits en session</h2>";}
    if(isset($_SESSION["errors"]) && !empty($_SESSION["errors"])){
        echo "<p class='errors'>".$_SESSION["errors"][count($_SESSION["errors"])-1]."</p>";
    }
?> 
    </div>
<div class="panneau">
    <h1>Ajouter un produit</h1>
    <form action="traitement.php" method="post">
        <p>
            <label>
                Nom produit 🎁
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit 💰
                <input type="number" min="0" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée ⚖
                <input type="number" min="0" name="qtt" value="1">
            </label>
        </p>
        <p>
            <input class="boutton" type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>
</div>
    
</body>
</html>