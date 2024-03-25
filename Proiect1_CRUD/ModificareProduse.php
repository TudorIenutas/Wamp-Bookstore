<?php

session_start();
// Daca utilizatorul nu este conectat => redirectioneaza la pagina de autentificare 
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

//conectare baza de date
include("Conectare.php");
//Modificare datelor
//se preia id din pagina vizualizare
$error='';
if (!empty($_POST['id']))
{
    if (isset($_POST['submit']))
    {
        //verificam daca id-ul din URL este unul valid
        
        if (is_numeric($_POST['id']))
        {
            //preluam variabilele din URL/form
            $id = $_POST['id'];
            $nume = htmlentities($_POST['name'],ENT_QUOTES);
            $cod = htmlentities($_POST['code'],ENT_QUOTES);
            $img = htmlentities($_POST['image'],ENT_QUOTES);
            $pret = htmlentities($_POST['price'],ENT_QUOTES);
            $desc = htmlentities($_POST['desc'],ENT_QUOTES);
            
            //verificam daca campurile nu sunt goale
            if ($nume==''||$cod==''||$img==''||$pret==''||$desc=='')
            {
                //daca sunt goale afisam mesaj de eroare
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            }
            else
            {
                //daca nu sunt erori se realizeaza update
                if ($stmt = $mysqli->prepare("UPDATE tbl_product SET name=?, code=?, image=?, price=?, description=? WHERE id='".$id."'"))
                {

                    $stmt->bind_param("sssds",$nume,$cod,$img,$pret,$desc);
                    $stmt->execute();
                    $stmt->close();
                }
                //mesaj de eroare in caz ca nu se poate face update
                else
                {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        }
        //daca variabila 'id' nu este valida, afisam mesaj de eroare
        else
        {
            echo "id incorect!";
        }
    }
}
?>

<html> 
    <head><title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
    <link href="style\style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<body>
    <h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
    <?php if ($error != '') 
    {
    echo "<div style='padding:4px; border:1px solid red; color:red'>".$error."</div>";
    } ?>
    <form action="" method="post">
    <div>
    <?php if ($_GET['id'] != '') { ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
    <p>ID: <?php echo $_GET['id'];
    if ($result = $mysqli->query("SELECT * FROM tbl_product where id='".$_GET['id']."'"))
    {
    if ($result->num_rows > 0)
    { $row = $result->fetch_object();?></p>
    <strong>Nume: </strong> <input type="text" name="name" value="<?php echo$row->name;?>"/><br/>
    <strong>Cod: </strong> <input type="text" name="code" value="<?php echo$row->code;?>"/><br/>
    <strong>Imagine: </strong> <input type="text" name="image" value="<?php echo$row->image;?>"/><br/>
    <strong>Pret: </strong> <input type="number" name="price" value="<?php echo $row->price;?>"/><br/>
    <strong style="float:left;">Descriere:</strong><textarea name="desc" rows="15" cols="100"><?php echo $row->description;                                        }
    }
    }?></textarea><br/>
    <br/>
    <input type="submit" name="submit" value="Submit" />
    <a href="VizualizareProduse.php">Vizualizare</a>
</div>

</body>
</html>