<?php
session_start();
// Daca utilizatorul nu este conectat => redirectioneaza la pagina de autentificare 
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare inregistrari</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="style\style.css">
</head>
<body>
    <img src="style\images\logo.png" height="50" ><br/>
    <nav class="navtop">
        <div>
            <a href="Home.php"><i class="fas fa-home"></i>Home</a>
            <a href="VizualizareClienti.php"><i class="fas fa-list"></i>Clienti</a>
            <a href="Logout.php"><i class="fas fa-user"></i>Logout</a>
        </div>
    </nav>
    <h1>Inregistrarile din tabela produse</h1>
    <p><b>Toate inregistrarile din produse</b></p>
    <?php
    //conectare baza de date
    include("Conectare.php");
    //se preiau inregistrarile din baza de date
    if ($result=$mysqli->query("SELECT * FROM tbl_product ORDER BY id"))
    {
        //Afisare inregistrari pe ecran
        if ($result->num_rows>0)
        {
            //afisarea inregistrarilor intr-o tabela
            echo"<table border='1' cellpadding='10'>";

            //antetul tabelului
            echo "<tr><th>ID</th><th>Nume Produs</th><th>Cod Produs</th><th>Imagine</th><th>Pret</th><th></th><th></th></tr>";

            while ($row = $result->fetch_object())
            {
                //definirea unei linii pt fiecare inregistrare
                echo"<tr>";
                echo"<td>".$row->id."</td>";
                echo"<td>".$row->name."</td>";
                echo"<td>".$row->code."</td>";
                echo"<td>".$row->image."</td>";
                echo"<td>".$row->price." Lei</td>";
                echo"<td><a href='ModificareProduse.php?id=".$row->id."'>Modificare</a></td>";
                echo"<td><a href='StergereProduse.php?id=".$row->id."'>Stergere</a></td>";
                echo"</tr>";
            }

            echo"</table>";


        }
        // daca nu sunt inregisrari se afiseaza un rezultat de eroare
        else{
            echo"Nu sunt inregistrari in tabela!";
        }

    }
    //eroare in caz de esec la interogare
    else{
        echo"Error".$mysqli->error();
    }


    //se inchide
    $mysqli->close();
    
?>
<a href="InserareProduse.php">Adaugarea unei noi inregistrari</a>





</body>
</html>

