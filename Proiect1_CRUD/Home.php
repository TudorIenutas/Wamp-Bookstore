<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
header('Location: index.php');
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pagina proiect parolata</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="style\style.css">
</head>
<body class="loggedin">
    <img src="style\images\logo.png" height="50" ><br/>
    <nav class="navtop">
        <div>
            <a href="VizualizareProduse.php"><i class="fas fa-list"></i>Produse</a>
            <a href="VizualizareClienti.php"><i class="fas fa-list"></i>Clienti</a>
            <a href="Logout.php"><i class="fas fa-user"></i>Logout</a>
        </div>
    </nav>
    <div class="content">
        <h2>Pagina cu parola</h2>
        <p>Bine ati revenit, <?=$_SESSION['name']?>!</p>
    </div>
</body>
</html>
