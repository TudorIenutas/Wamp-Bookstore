<?php
session_start();
// informatii conectare
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'proiect1_magazin';
// se incearca conectarea
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
// Daca exista o eroare, opriti scriptul si se afiseaza eroarea
exit('Esec conectare MySQL: ' . mysqli_connect_error());
}
// Acum verificam daca datele din formularul de autentificare au fost trimise
//isset () va verifica daca datele exista.
if ( !isset($_POST['username'], $_POST['password']) ) {
// Nu s-au putut obtine datele care ar fi trebuit trimise
exit('Completati username si password !');
}
// Pregatiti SQL-ul nostru, pregatirea instructiunii SQL va impiedica injectia SQL.
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
    // Parametrii de legare (s = sir, i = int, b = blob etc.), in cazul nostru numele de utilizator este un sir, 
    //asa ca vom folosi "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Stocati rezultatul astfel incat sa putem verifica daca contul exista in baza de date.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password);
    $stmt->fetch();
    // Contul exista, acum verificam parola.
    // Nota: nu uitati sa utilizati password_hash in fisierul de inregistrare pentru a stoca parolele hash.
    if (password_verify($_POST['password'], $password)) {
    // Verification success! User has logged in!
    // Creati sesiuni, astfel incat sa stim ca utilizatorul este conectat, acestea actioneaza practic ca 
    //cookie-uri, dar retin datele de pe server.
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $_POST['username'];
    $_SESSION['id'] = $id;
    echo 'Bine ati venit' . $_SESSION['name'] . '!';
    header('Location: home.php');
    } else {
    // password incorect
    echo 'Incorrect username sau password!';
    }
    } else {
    // username incorect
    echo 'Incorrect username sau password!';
    }
    $stmt->close();
}
?>