<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="style\style.css">
</head>
<body>
    <!-- Logo magazin -->
    <div class="logo">
        <img src="style\images\logo.png" height="50" ><br/>
    </div>
    <!-- Bara de navigare -->
    <nav class="navtop">
        <div>
            <a class="nav_link" href="Magazin.php"><i class="fas fa-book"></i>Magazin |</a>
            <a class="nav_link" href='Logout.php'><i class='fas fa-user'></i> Logout</a>
        </div>
    </nav>
    <div>
        <h1>Comanda finalizata</h1>
        <?php
           session_start();
           session_destroy();
        ?>
    </div>
</body>
</html>