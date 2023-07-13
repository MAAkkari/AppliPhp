<?php 
session_start();
$action = $_GET['action'];
switch($action){
    case 'addProduct' :
        $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST,"price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST,"qtt", FILTER_VALIDATE_INT);
        if($name && $price && $qtt){
            $product=[
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt,
            ];

            $_SESSION["errors"][] = 'ajout du produit "'.$product["name"].'" avec succes';
            $_SESSION["products"][]=$product;
            header("Location: index.php");
        }
        else{
            $_SESSION["errors"][] = "Veuillez remplir tous les champs";
            header("Location: index.php");
        }
    break;

    case'deleteProduct':
        $index=$_POST['delete'];
        $nom= $_SESSION["products"][$index]["name"];
        unset($_SESSION["products"][$index]);
        $_SESSION["products"] = array_values($_SESSION["products"]);
        $_SESSION["errors"][] = 'suppression du produit "'. $nom .'" avec succes !';
        header("Location: recap.php");
    break;
    
    case'deleteAllProduct':
        $_SESSION["products"]=[];
        $_SESSION["products"] = array_values($_SESSION["products"]);
        $_SESSION["errors"][] = 'suppression de tout les produits avec succes !';
            
        header("Location: recap.php");
    break;

    case'increaseQtt':
        $index=$_POST["plus"];
        $_SESSION["products"][$index]["qtt"]+=1;
        $_SESSION["products"] = array_values($_SESSION["products"]);
        header("Location: recap.php");
    break;

    case'lowerQtt':
        $index=$_POST["moin"];
        $_SESSION["products"][$index]["qtt"]-=1;
        $_SESSION["products"] = array_values($_SESSION["products"]);

        if($_SESSION["products"][$index]["qtt"]<=0){
            $nom= $_SESSION["products"][$index]["name"];
            unset($_SESSION["products"][$index]);
            $_SESSION["products"] = array_values($_SESSION["products"]);
            $_SESSION["errors"][] = 'suppression du produit "'. $nom .'" avec succes !';
            }
        header("Location: recap.php");
    break;
}
?>