<?php 
    session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
</head>
<body>
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