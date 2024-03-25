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



//verificam daca sunt completate
if ($username==''||$pass==''||$email==''||$str==''||$oras==''||$tara==''||$codpostal==''||$nrcard==''||$tipcard==''||$dataexp==''||$acceptareemail==''||$nume=='')
    {
        //daca sunt goale se afis un mesaj
        $error='Error: Campuri goale!\n';
    }
    else
    {
        //insert
        if ($stmt = $mysqli->prepare("INSERT INTO clienti (client_username, client_pass, client_email, client_str, client_oras, client_tara, client_codpost, client_nrcard, client_tipcard, client_dataexp, acceptareemail, client_nume) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"))
        {
            $stmt->bind_param("sssssssissis",$username,$pass,$email,$str,$oras,$tara,$codpostal,$nrcard,$tipcard,$dataexp,$acceptareemail,$nume);
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="style\style.css">
</head> 
<body>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if($error != ''){
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>

<form action="" method="post">
<div>
<strong>Username:</strong><input type="text" name="username" value=""/><br/>
<strong>Parola:</strong><input type="text" name="pass" value=""/><br/>
<strong>Email:</strong><input type="text" name="email" value=""/><br/>
<strong>Strada:</strong><input type="text" name="str" value=""/><br/>
<strong>Oras:</strong><input type="text" name="oras" value=""/><br/>
<strong>Tara:</strong><input type="text" name="tara" value=""/><br/>
<strong>Cod postal:</strong><input type="text" name="codpostal" value=""/><br/>
<strong>Nr card:</strong><input type="number" name="nrcard" value=""/><br/>
<strong>Tip card:</strong><input type="text" name="tipcard" value=""/><br/>
<strong>Data exp:</strong><input type="date" name="dataexp" value=""/><br/>
<strong>Acceptare email:</strong><input type="number" name="acceptareemail" value=""/><br/>
<strong>Nume:</strong><input type="text" name="nume" value="1"/><br/>
<input type="submit" name="submit" value="Submit" />
<a href="VizualizareClienti.php">Vizualizare</a>

</div>
</form>
</body>
</html>