<?php
    session_start(); 
    if(!isset($_SESSION['udanarejestracja'])) {
        header('Location: index.php');
        exit();
    }
    else {
        unset($_SESSION['udanarejestracja']);
    }

?>

<!DOCTYPE html>
<html lang = "pl">
    <head>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;700&display=swap" rel="stylesheet">
        <title>Wisielec - Karolina Stopa, Kamil Słoczyński, Jakub Moniakowski</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body onselectstart="return false" onselect="return false" oncopy="return false">
        <div id="container">
            <div id="haslo">
                
            </div>
            <div id ="szubienica">
                <img src="img/s9.jpg" alt="" />
            </div>
            <div id ="login">

                <br/>Utworzono konto! <a href="index.php">Przejdź do logowania...</a>
            </div>
            <div style="clear:both;"></div>
        </div>
    </body>
</html>

