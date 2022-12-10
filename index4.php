<?php declare(strict_types=1);
session_start();

if (!isset($_SESSION['loggedin']))
{
    header('Location: index3.php');
    exit();
}

$user = $_SESSION['user'];


$auth_file = file_get_contents('auth.txt');
$lines = explode("\n", $auth_file);
$host = substr($lines[0], 5);
$username = substr($lines[1], 9);
$password = substr($lines[2], 9);
$database = substr($lines[3], 7);
$link = mysqli_connect($host, $username, $password, $database);

if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
mysqli_query($link, "SET NAMES 'utf8'");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<BODY style="padding: 15px">
<a href="logout.php">Wyloguj się</a>
<br>
<a href="index.php">Powrót do menu głównego</a>
<br>
<br>
<br>
<br>
<?php

?>
</BODY>
</HTML>