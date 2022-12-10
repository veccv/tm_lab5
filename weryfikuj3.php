<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
$user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8");
$pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8");

$auth_file = file_get_contents('auth.txt');
$lines = explode("\n", $auth_file);
$host = substr($lines[0], 5);
$username = substr($lines[1], 9);
$password = substr($lines[2], 9);
$database = substr($lines[3], 7);
$link = mysqli_connect($host, $username, $password, $database);
if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
mysqli_query($link, "SET NAMES 'utf8'");
$result = mysqli_query($link, "SELECT * FROM user WHERE login='$user'");
$rekord = mysqli_fetch_array($result);

session_start();
$last_unsuccessful_login = $_SESSION['last_unsuccessful_login'];
$time_now = time();


if (($last_unsuccessful_login + 60) < $time_now) {
    if (!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
    {
        $_SESSION['last_unsuccessful_login'] = time();
        mysqli_close($link); // zamknięcie połączenia z BD
        header('Location: index3.php');
        exit();
    } else { // jeśli $rekord istnieje
        if ($rekord['password'] == $pass) // czy hasło zgadza się z BD
        {
            echo "Logowanie Ok. User: {$rekord['username']}. Hasło: {$rekord['password']}";
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $user;

            header('Location: index4.php');
        } else {
            $_SESSION['last_unsuccessful_login'] = time();
            mysqli_close($link);
            header('Location: index3.php');
            exit();
        }
    }
} else {
    echo "Musisz poczekać minutę aby spróbować zalogować się ponownie!";
}
?>
</BODY>
</HTML>