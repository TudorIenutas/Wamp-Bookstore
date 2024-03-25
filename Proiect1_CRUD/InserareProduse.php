<?php
session_start();
// Daca utilizatorul nu este conectat => redirectioneaza la pagina de autentificare 
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
//preluam datele din formular
$nume = htmlentities($_POST['name'],ENT_QUOTES);
$cod = htmlentities($_POST['code'],ENT_QUOTES);
$img = htmlentities($_POST['image'],ENT_QUOTES);
$pret = htmlentities($_POST['price'],ENT_QUOTES);
$desc = htmlentities($_POST['desc'],ENT_QUOTES);




//verificam daca sunt completate
if ($nume==''||$cod==''||$img==''||$pret==''||$desc=='')
    {
        //daca sunt goale se afis un mesaj
        $error='Error: Campuri goale!\n';
    }
    else
    {
        //insert
        if ($stmt = $mysqli->prepare("INSERT INTO tbl_product (name, code, image, price, description) VALUES (?,?,?,?,?)"))
        {
            $stmt->bind_param("sssds",$nume,$cod,$img,$pret,$desc);
            $stmt->execute();
            $stmt->close();
        }
        //eroare la innserare
        else{

            echo"Error: Nu se poate executa insert!\n";
        }
    }


}
//se inchide conexiunea mysqli
$mysqli->close();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head> <title><?php echo "Inserare inregistrare"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="style\style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head> 
<body>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if($error != ''){
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>

<form action="" method="post">
<div>
<strong>Nume:</strong><input type="text" name="name" value=""/><br/>
<strong>Cod:</strong><input type="text" name="code" value=""/><br/>
<strong>Imagine:</strong><input type="text" name="image" value=""/><br/>
<strong>Pret:</strong><input type="number" name="price" value=""/><br/>
<strong style="float:left;">Descriere:</strong><textarea name="desc" value="" rows="15" cols="100"></textarea><br/>
<input type="submit" name="submit" value="Submit" />
<a href="VizualizareProduse.php">Vizualizare</a>

</div>
</form>
</body>
</html>