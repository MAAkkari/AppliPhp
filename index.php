<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouet produit</title>
</head>
<body>
    <h1>Ajouter un produit</1>
    <form action="traitement.php" method="post">
        <p>
            <label>
                Nom produit :
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" min="0" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée :
                <input type="number" min="0" name="qtt" value="1">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>
</body>
</html>