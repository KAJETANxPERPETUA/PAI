<?php
    session_start();
    if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
        header('Locaton: index.php');
        exit();
    }
?>

<?php

$login = $_POST['login'];
$haslo = $_POST['haslo'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisielec";

// Create connection
$connection = @new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else {
    $sql = "SELECT * FROM players WHERE user='$login' AND haslo='$haslo'";
    if ($result = @$connection->query($sql)) {
        $ile = $result->num_rows;
        if($ile>0) {

            $_SESSION['zalogowany']= true;
            
            $wiersz = $result->fetch_assoc();
            $_SESSION['id']= $wiersz['id'];
            $_SESSION['user'] = $wiersz['user'];
            $_SESSION['wygrane'] = $wiersz['wygrane'];
            $_SESSION['przegrane'] = $wiersz['przegrane'];
            $_SESSION['ratio'] = $wiersz['ratio'];
            
            unset($_SESSION['blad']);
            $result->free_result();
            header('Location:game.php');
        }
        else {
            $_SESSION['blad'] = '<span style="color:red"><br/>Nieprawidłowe dane logowania!</span>';
            header('Location:index.php');
        }
    }

    $connection->close();
}
?>
