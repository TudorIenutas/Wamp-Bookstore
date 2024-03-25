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
            <a href="VizualizareProduse.php"><i class="fas fa-list"></i>Produse</a>
            <a href="Logout.php"><i class="fas fa-user"></i>Logout</a>
        </div>
    </nav>
    <h1>Inregistrarile din tabela clienti</h1>
    <p><b>Toate inregistrarile din clienti</b></p>
    <?php
    //conectare baza de date
    include("Conectare.php");
    //se preiau inregistrarile din baza de date
    if ($result=$mysqli->query("SELECT * FROM clienti ORDER BY client_id"))
    {
        //Afisare inregistrari pe ecran
        if ($result->num_rows>0)
        {
            //afisarea inregistrarilor intr-o tabela
            echo"<table border='1' cellpadding='10' width='100%'>";

            //antetul tabelului
            echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Strada</th><th>Oras</th><th>Tara</th><th>Cod postal</th><th>Nr card</th><th>Tip card</th><th>Data exp</th><th>Acceptare email</th><th>Nume</th><th></th><th></th></tr>";

            while ($row = $result->fetch_object())
            {
                //definirea unei linii pt fiecare inregistrare
                echo"<tr>";
                echo"<td>".$row->client_id."</td>";
                echo"<td>".$row->client_username."</td>";
                echo"<td>".$row->client_email."</td>";
                echo"<td>".$row->client_str."</td>";
                echo"<td>".$row->client_oras."</td>";
                echo"<td>".$row->client_tara."</td>";
                echo"<td>".$row->client_codpost."</td>";
                echo"<td>".$row->client_nrcard."</td>";
                echo"<td>".$row->client_tipcard."</td>";
                echo"<td>".$row->client_dataexp."</td>";
                echo"<td>".$row->acceptareemail."</td>";
                echo"<td>".$row->client_nume."</td>";
                echo"<td><a href='ModificareClienti.php?id=".$row->client_id."'>Modificare</a></td>";
                echo"<td><a href='StergereClienti.php?id=".$row->client_id."'>Stergere</a></td>";
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
<a href="InserareClienti.php">Adaugarea unei noi inregistrari</a>



</body>
</html>

