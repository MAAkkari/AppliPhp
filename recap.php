<?php 
    ob_start();
    session_start();
?> 
<a href="index.php">retourner au formulaire</a>
    <?php 
     if(isset($_SESSION["products"]) && !empty($_SESSION["products"])){
        $total=0;
        foreach($_SESSION["products"] as $index=>$product){
            $total+=$product["qtt"];
        }
        echo "<h2>".$total." Produits en session</h2>";
     }
     if(isset($_SESSION["errors"]) && !empty($_SESSION["errors"])){
        echo "<p class='errors'>".$_SESSION["errors"][0]."</p>";
        $_SESSION["errors"]=[];
    }
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
                        "<td><div class='flex'><form class='f3' action='traitement.php?action=lowerQtt' method='post' ><input class='adjust.btn' type='hidden' name='moin' value='$index'>
                        <div class ='container'><button class='btnf3'type='submit'>-</button></div></form>".$product["qtt"].
                        "<form class='f3' action='traitement.php?action=increaseQtt' method='post'><input class='adjust.btn' type='hidden' name='plus' value='$index'>
                        <div class ='container'><button class='btnf3'type='submit'>+</button></div></form></div></td>",
                        "<td>".number_format($product["total"],2,",","&nbsp;")."&nbsp;€</td>",
                        "<td style='width: 50px' class='img_container'><img class='img' src='".$_SESSION['products'][$index]['image']."'></td>",
                        "<td> <form class='form2' method='POST' action='traitement.php?action=deleteProduct'><input class='inputf2' type='hidden' name='delete' value='$index'>
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
        echo "<form action='traitement.php?action=deleteAllProduct' method='post'><input class='bouttonDeleteALL' type='submit' name='deleteAll' value='Supprimer tout les produits'></form>";
    }   

    $title="tableau recapitulatif";
    $contenu = ob_get_clean();
    require_once('template.php');
    ?> 
