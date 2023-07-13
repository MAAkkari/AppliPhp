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
     echo "<h2>".count($_SESSION["products"])." Produits en session</h2>";
    //verifie si la clef products n'existe pas dans $_session ou si elle existe mais qu'elle est vite
    if(!isset($_SESSION["products"])|| empty($_SESSION["products"])){
        echo "<p>Aucun Produit en session...</p>";
    }
    else{
        echo"<table >", 
                "<thread>",
                    "<tr>",
                    "<th>N°</th>",
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
                        "<td><div class='flex'><form class='f3' action='traitement.php' method='post' ><input class='adjust.btn' type='hidden' name='moin' value='$index'>
                        <div class ='container'><button class='btnf3'type='submit'>-</button></div></form>".$product["qtt"].
                        "<form class='f3' action='traitement.php' method='post'><input class='adjust.btn' type='hidden' name='plus' value='$index'>
                        <div class ='container'><button class='btnf3'type='submit'>+</button></div></form></div></td>",
                        "<td>".number_format($product["total"],2,",","&nbsp;")."&nbsp;€</td>",
                        "<td> <form class='form2' method='POST' action='traitement.php'><input class='inputf2' type='hidden' name='delete' value='$index'>
                        <button class='btnf2'type='submit'>Delete</button></form></td>",
                    "</tr>";
                $totalGeneral+= $product["total"];
            }      
            echo    "<tr>",
                        "<td colspan=4> total général : </td>",
                        "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</strong></td>",
                    "<tr>",
            "</tbody>",
        "<table>";
        echo "<form action='traitement.php' method='post'><input class='bouttonDeleteALL' type='submit' name='deleteAll' value='Supprimer tout les produits'></form>";
    }   

    ?> 
</body>
</html>