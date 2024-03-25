<?php
// Schimbati acest lucru cu informatiile despre conexiune
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = "";
$DATABASE_NAME = 'proiect1_magazin';
//incearca conectarea la baza
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
// Daca exista o eroare, opriti scriptul si se afiseaza eroarea
exit('Esec conectare MySQL: ' . mysqli_connect_error());
}
//Daca nu se pot obtine datele care ar trebui trimise, opriti scriptul si se afiseaza eroarea
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    exit('Nu s-au dat datele!');
}
//Verificam daca inregistrarile trimise nu sunt goale
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    // Daca cel putin una e goala
    exit('Nu ati completat campurile!');
}
//Validam datele de intrare
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Email nu este valid!');
    }
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
    exit('Username nu este valid!');
    }
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {          
    exit('Password trebuie sa fie intre 5 si 20 charactere!');
    }
//Verificam daca exista deja contul
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
// hash parola folosind functia PHP password_hash
$stmt->bind_param('s', $_POST['username']); 
$stmt->execute();
$stmt->store_result();
// Memoram rezultatul, astfel incat sa putem verifica daca contulexista in baza de date.
    if ($stmt->num_rows > 0) {
    // Username exista
    echo 'Username existent, alegeti altul!';
    } else {
        if ($stmt = $con->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {
        // Nu dorim sa expunem parole in baza noastra de date, asa ca hash parola si utilizati 
        //password_verify atunci cand un utilizator se conecteaza.
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
        $stmt->execute();
        echo 'Inregistrat cu succes!';
        header('Location: index.html');
        } else {
            // Ceva nu este in regula cu declaratia sql, verificati pentru a va asigura ca tabelul conturilor 
            //exista cu toate cele 3 campuri.
            echo 'Nu se poate face prepare statement!';
            }
            }
            $stmt->close();
            } else {
            // Ceva nu este in regula cu declaratia sql, verificati pentru a va asigura ca tabelul conturilor 
            //exista cu toate cele 3 campuri.
            echo 'Nu se poate face prepare statement!';
            }
            $con->close();
            ?>
            