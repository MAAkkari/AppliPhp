<?php 
session_start();
//Vefifie l'exitance de la clef "submit" dans l'array de $_POST, isset() verifie que c'est non nul et definie
if (isset($_POST['submit'])){
    
    $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST,"price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST,"qtt", FILTER_VALIDATE_INT);
    
    if($name && $price && $qtt){
        $product=[
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price*$qtt
        ];

        $_SESSION["products"][]=$product;
    }
}
header("Location:index.php");
?>