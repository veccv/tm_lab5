<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</HEAD>
<BODY>
<?php
include 'Database.php';
$user = htmlentities($_POST['user'], ENT_QUOTES, "UTF-8");
$pass = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");
$pass_repeat = htmlentities($_POST['pass_repeat'], ENT_QUOTES, "UTF-8");


if (!Database::getConnection()) {
    echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
}
Database::getConnection()->query("SET NAMES 'utf8'");

$rekord = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE login='$user'"));
if (!$rekord)
{
    if ($pass == $pass_repeat) {
        Database::getConnection()->query("INSERT INTO user (login, password) VALUES ('$user', '$pass')");
        Database::getConnection()->close();
        echo "Zarejestrowano użytkownika $user z hasłem $pass";

    } else {
        echo "Podane hasła nie są takie same";
    }
} else {
    echo "Podany użytkownik już istnieje";
}
?>
<br>
<br>
<br>
<br>
<a href="index.php">Powrót do menu głównego aplikacji</a>
</BODY>
</HTML>