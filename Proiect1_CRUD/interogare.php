<?php
//conectare
$hostname = 'localhost';
$username = 'root';
$password = '';
$db = 'proiect1_magazin';
$mysqli = new mysqli($hostname, $username, $password, $db);
//verificare
if (!mysqli_connect_errno()){
    echo 'Conectat';
}
else {
    echo 'Nu s-a conectat';
    exit;
}


//declari varibilele
$price = 40;


if ($stmt = $mysqli->prepare("SELECT * FROM tbl_product WHERE price>?")){
    $stmt->bind_param("i", $price);
    $stmt->execute();

    $productResult = $stmt->get_result();

    foreach ($productResult as $product){
        foreach ($product as $item){
            echo "<p>".$item."</p>";
        }
    }
}




?>