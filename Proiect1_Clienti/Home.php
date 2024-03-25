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
    <link href="style\style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    
</head>
<body class="loggedin">
   <!-- Logo magazin -->
   <div class="logo">
        <img src="style\images\LOGO.png" height="50" ><br/>
    </div>
    <!-- Bara de navigare -->
    <nav class="navtop">
        <div>
        <?php 
            
                if (isset($_SESSION['loggedin'])){
                echo "<a class="."'nav_link'"." href='Profile.php?id=".$_SESSION['id']."'><i class="."'fas fa-clipboard'"."></i>Profil |</a>"; 
                }
             ?>
            <a class="nav_link" href="Magazin.php"><i class="fas fa-book"></i>Magazin |</a>
            <a class="nav_link" href="Logout.php"><i class="fas fa-user"></i>Logout</a>
        </div>
    </nav>
    <div class="content">
        <h2>Pagina cu parola</h2>
        <p>Bine ati revenit, <?=$_SESSION['name']?>!</p>
    </div>
</body>
</html>
