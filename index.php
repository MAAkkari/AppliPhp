<?php 
ob_start();
?>
    <div class="menu">
        <a href="recap.php">Voir le tableau recapitulatif</a>
        <?php 
    session_start();
    if(isset($_SESSION["products"]) && !empty($_SESSION["products"])){
        $total=0;
        foreach($_SESSION["products"] as $index=>$product){
            $total+=$product["qtt"];
        }
        echo "<h2>".$total." Produits en session</h2>";}
    if(isset($_SESSION["errors"]) && !empty($_SESSION["errors"])){
        echo "<p class='errors'>".$_SESSION["errors"][0]."</p>";
        $_SESSION["errors"]=[];
    }
?> 
    </div>
<div class="panneau">
    <h1>Ajouter un produit</h1>
    <form class="f1" action="traitement.php?action=addProduct" method="post">
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
    
<?php

$title="ajouter un produit";
$contenu = ob_get_clean();

require_once('template.php');