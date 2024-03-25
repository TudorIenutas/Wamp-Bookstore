<?php
/***mysql hostname ***/
$hostname ='localhost';
/***mysql username ***/
$username = 'root';
/*** mysql password ***/
$password = '';
/*** baza de date ***/
$db = 'proiect1_magazin';
/*** se creaza un obiect mysqli ***/
$mysqli = new mysqli($hostname, $username, $password, $db);
/* se verifica daca s-a realizat conexiunea */
if(!mysqli_connect_errno())
{
echo '<p>Conectat la baza de date: '. $db.'</p>';
// $mysqli->close();
}
else
{
echo 'Nu se poate connecta';
exit();
}
?>