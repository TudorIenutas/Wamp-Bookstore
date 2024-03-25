<?php

session_start();
// Daca utilizatorul nu este conectat => redirectioneaza la pagina de autentificare 
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

// conectare la baza de date database
include("Conectare.php");

// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    // preluam variabila id din URL
    $id = $_GET['id'];


    // stergem inregistrarea cu ib=$id
    if ($stmt = $mysqli->prepare("DELETE FROM tbl_product WHERE id = ? LIMIT 1"))
    {
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
    else
    {
        echo "ERROR: Nu se poate executa delete.";
    }
        $mysqli->close();
        echo "<div>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p><a href=\"VizualizareProduse.php\">Vizualizare</a></p>";



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head> <title><?php echo "Inserare inregistrare"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="style\style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head> 
<body>

</body>
</html>