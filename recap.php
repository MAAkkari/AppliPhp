<?php 
    ob_start();
    session_start();
?> 
<a href="index.php">retourner au formulaire</a>

    <?php //affichage du nombre de produits en session
     if(isset($_SESSION["products"]) && !empty($_SESSION["products"])){
        $total=0;
        foreach($_SESSION["products"] as $index=>$product){
            $total+=$product["qtt"];
        }
        echo "<h2>".$total." Produits en session</h2>";
     }
     //affichage des messages d'erreur ou de succès 
     if(isset($_SESSION["errors"]) && !empty($_SESSION["errors"])){
        echo "<p class='errors'>".$_SESSION["errors"][0]."</p>";
        $_SESSION["errors"]=[];
    }
    //s'affiche si aucun produit en session
    if(!isset($_SESSION["products"])|| empty($_SESSION["products"])){
        echo "<p>Aucun Produit en session...</p>";
    }
    //creation du tableau recapitulatif
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

                    //case numero de produit
                    "<td>".$index."</td>",

                    //case nom du produit
                    "<td>".$product["name"]."</td>",

                    //case prix du produit
                    "<td>".number_format($product["price"],2,",","&nbsp;")."&nbsp;€</td>",

                    //case quantité du produit et bouton + et -
                    "<td><div class='flex'>
                        <form class='f3' action='traitement.php?action=lowerQtt' method='post' >
                            <input class='adjust.btn' type='hidden' name='moin' value='$index'>
                                <div class ='container'>
                                    <button class='btnf3'type='submit'>-</button>
                                </div>
                        </form>"
                        .$product["qtt"].
                        "<form class='f3' action='traitement.php?action=increaseQtt' method='post'>
                            <input class='adjust.btn' type='hidden' name='plus' value='$index'>
                                <div class ='container'>
                                    <button class='btnf3'type='submit'>+</button>
                                </div></form>
                        </div>
                    </td>",

                    //case total du produit
                    "<td>".number_format($product["total"],2,",","&nbsp;")."&nbsp;€</td>"  ;

                    //case image du produit
                    if(isset($_SESSION['products'][$index]['image'])){
                        echo"<td style='width: 50px' class='img_container'>
                                <img class='img' src='upload".$_SESSION['products'][$index]['image']."'>
                            </td>";
                    }

                    //case bouton supprimer " delete " 
                    echo"<td> 
                            <form class='form2' method='POST' action='traitement.php?action=deleteProduct'>
                                <input class='inputf2' type='hidden' name='delete' value='$index'>
                                    <button class='btnf2'type='submit'>Delete</button>
                            </form>
                        </td>",
                    "</tr>";

                    $totalGeneral+= $product["total"];

            }        //case total général
            echo    "<tr>",
                        "<td colspan=4> total général : </td>",
                        "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</strong></td>",
                    "<tr>",
            "</tbody>",
        "<table>";

        //bouton supprimer tout les produits
        echo"<form action='traitement.php?action=deleteAllProduct' method='post'>
                <input class='bouttonDeleteALL' type='submit' name='deleteAll' value='Supprimer tout les produits'>
            </form>";
    }   
    $title="tableau recapitulatif";
    $contenu = ob_get_clean();
    require_once('template.php');
    ?> 
