<?php 
session_start();
$action = $_GET['action'];
switch($action){ //switch selon l'action demandée dans les formulaires
    case 'addProduct' : //si l'action est addProduct on ajoute le produit au tableau de produits

        //récupération des données du formulaire et filtrage
        $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST,"price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST,"qtt", FILTER_VALIDATE_INT);

        //récupération de l'image et vérification de son extension et de ses erreur
        if(isset($_FILES["image"]) && !empty($_FILES["image"])){
            $tmpName = $_FILES["image"]["tmp_name"];
            $img_name = $_FILES["image"]["name"];
            $size = $_FILES["image"]["size"];
            $error = $_FILES["image"]["error"];
            $type = $_FILES["image"]["type"];
        
            $tabExtension=explode('.',$img_name);
            $extension=strtolower(end($tabExtension));
            $AcceptedExtensions=["jpg","jpeg","gif","png"];
            var_dump(in_array($extension,$AcceptedExtensions ));
            var_dump($error==0);
            if(in_array($extension,$AcceptedExtensions ) && $error==0 ){
                $uniqueName=uniqid("",true);
                $fileName=$uniqueName.".".$extension;
                move_uploaded_file($tmpName,'./upload'.$fileName);
            }
        }
        else{
            echo "mauvaise extension, taille trop élevé ou erreur ";
        }
        //si les données sont correctes, on les ajoute au tableau de produits
        if($name && $price && $qtt ){
            $product=[
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt,
                "image"=>$fileName,
            ];
        //ajout du produit dans le tableau de produits
            $_SESSION["errors"][] = 'ajout du produit "'.$product["name"].'" avec succes';
            $_SESSION["products"][]=$product;
            header("Location: index.php");
        }
        else{
            //sinon on affiche un message d'erreur
            $_SESSION["errors"][] = "Veuillez remplir tous les champs";
            header("Location: index.php");
        }
    break;

        //si l'action est deleteProduct, on supprime le produit du tableau de produits
    case'deleteProduct':
        $index=$_POST['delete'];
        $nom= $_SESSION["products"][$index]["name"];
        unset($_SESSION["products"][$index]);
        $_SESSION["products"] = array_values($_SESSION["products"]);
        $_SESSION["errors"][] = 'suppression du produit "'. $nom .'" avec succes !';
        header("Location: recap.php");
    break;
    
    case'deleteAllProduct'://si l'action est deleteAllProduct, on supprime tout les produits du tableau de produits
        $_SESSION["products"]=[];
        $_SESSION["products"] = array_values($_SESSION["products"]);
        $_SESSION["errors"][] = 'suppression de tout les produits avec succes !';
            
        header("Location: recap.php");
    break;

    case'increaseQtt'://si l'action est increaseQtt, on augmente la quantité du produit
        $index=$_POST["plus"];
        $_SESSION["products"][$index]["qtt"]+=1;
        //recalcul du total
        $_SESSION["products"][$index]["total"]=$_SESSION["products"][$index]["qtt"]*$_SESSION["products"][$index]["price"];

        $_SESSION["products"] = array_values($_SESSION["products"]);
        header("Location: recap.php");
    break;

    case'lowerQtt'://si l'action est lowerQtt, on diminue la quantité du produit
        $index=$_POST["moin"];
        $_SESSION["products"][$index]["qtt"]-=1;
        $_SESSION["products"][$index]["total"]=$_SESSION["products"][$index]["qtt"]*$_SESSION["products"][$index]["price"];
        $_SESSION["products"] = array_values($_SESSION["products"]);

        //si la quantité est inférieur ou égale à 0, on supprime le produit
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