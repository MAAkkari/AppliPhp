<?php 
    session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;1,100;1,400&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<a href="index.php">retourner au formulaire</a>
    <?php 
    //verifie si la clef products n'existe pas dans $_session ou si elle existe mais qu'elle est vite
    if(!isset($_SESSION["products"])|| empty($_SESSION["products"])){
        echo "<p>Aucun Produit en session...</p>";
    }
    else{
        echo"<table>", 
                "<thread>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                    "<tr>",
                "<thread>",  
                "<tbody>";
            $totalGeneral=0;
            foreach($_SESSION["products"] as $index=>$product){  
                echo"<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product["name"]."</td>",
                        "<td>".number_format($product["price"],2,",","&nbsp;")."&nbsp;€</td>",
                        "<td>".$product["qtt"]."</td>",
                        "<td>".number_format($product["total"],2,",","&nbsp;")."&nbsp;€</td>",
                    "</tr>";
                $totalGeneral+= $product["total"];
            }      
            echo    "<tr>",
                        "<td colspan=4> total général : </td>",
                        "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</strong></td>",
                    "<tr>",
            "</tbody>",
        "<table>";
    }       
    ?> 
</body>
</html>