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
            $username = htmlentities($_POST['username'],ENT_QUOTES);
            $pass = htmlentities($_POST['pass'],ENT_QUOTES);
            $email = htmlentities($_POST['email'],ENT_QUOTES);
            $str = htmlentities($_POST['str'],ENT_QUOTES);
            $oras = htmlentities($_POST['oras'],ENT_QUOTES);
            $tara = htmlentities($_POST['tara'],ENT_QUOTES);
            $codpostal = htmlentities($_POST['codpostal'],ENT_QUOTES);
            $nrcard = htmlentities($_POST['nrcard'],ENT_QUOTES);
            $tipcard = htmlentities($_POST['tipcard'],ENT_QUOTES);
            $dataexp = htmlentities($_POST['dataexp'],ENT_QUOTES);
            $acceptareemail = htmlentities($_POST['acceptareemail'],ENT_QUOTES);
            $nume = htmlentities($_POST['nume'],ENT_QUOTES);
            //verificam daca campurile nu sunt goale
            if ($username==''||$pass==''||$email==''||$str==''||$oras==''||$tara==''||$codpostal==''||$nrcard==''||$tipcard==''||$dataexp==''||$acceptareemail==''||$nume=='')
            {
                //daca sunt goale afisam mesaj de eroare
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            }
            else
            {
                //daca nu sunt erori se realizeaza update
                if ($stmt = $mysqli->prepare("UPDATE clienti SET client_username=?, client_pass=?, client_email=?, client_str=?, client_oras=?, client_tara=?, client_codpost=?, client_nrcard=?, client_tipcard=?, client_dataexp=?, acceptareemail=?, client_nume=? WHERE client_id='".$id."'"))
                {

                    $stmt->bind_param("sssssssissis",$username,$pass,$email,$str,$oras,$tara,$codpostal,$nrcard,$tipcard,$dataexp,$acceptareemail,$nume);
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="style\style.css">
</head>
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
    if ($result = $mysqli->query("SELECT * FROM clienti where client_id='".$_GET['id']."'"))
    {
    if ($result->num_rows > 0)
    { $row = $result->fetch_object();?></p>
    <strong>Username: </strong> <input type="text" name="username" value="<?php echo$row->client_username;?>"/><br/>
    <strong>Parola: </strong> <input type="text" name="pass" value="<?php echo$row->client_pass;?>"/><br/>
    <strong>Email: </strong> <input type="text" name="email" value="<?php echo$row->client_email;?>"/><br/>
    <strong>Strada: </strong> <input type="text" name="str" value="<?php echo$row->client_str;?>"/><br/>
    <strong>Oras: </strong> <input type="text" name="oras" value="<?php echo$row->client_oras;?>"/><br/>
    <strong>Tara: </strong> <input type="text" name="tara" value="<?php echo$row->client_tara;?>"/><br/>
    <strong>Cod postal: </strong> <input type="text" name="codpostal" value="<?php echo$row->client_codpost;?>"/><br/>
    <strong>Nr card: </strong> <input type="number" name="nrcard" value="<?php echo$row->client_nrcard;?>"/><br/>
    <strong>Tip card: </strong> <input type="text" name="tipcard" value="<?php echo$row->client_tipcard;?>"/><br/>
    <strong>Data exp: </strong> <input type="datetime" name="dataexp" value="<?php echo$row->client_dataexp;?>"/><br/>
    <strong>Acceptare email: </strong> <input type="number" name="acceptareemail" value="<?php echo$row->acceptareemail;?>"/><br/>
    <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->client_nume;}
    }
    }?>"/><br/>
    <br/>
    <input type="submit" name="submit" value="Submit" />
    <a href="VizualizareClienti.php">Vizualizare</a>
</div>

</body>
</html>