<?php
  session_start(); 
  if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) {
    header('Location: game.php');
  exit();
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
                <form action="login.php" method="post">
                    <br/><br/>Login:<input type="text" name="login" /><br/><br/>
                    Haslo:<input type="password" name="haslo" /><br/><br/>
                    <input type="submit" value="Zaloguj" /><br/><br/>
                </form>
                <br/><a href="rejestracja.php">Utwórz konto</a>
                <br/><br/>Made by Karolina Stopa, Jakub Moniakowski, Kamil Słoczyński aka KAJETAN x PERPETUA feat. SOMSIAD
                <?php 
                    if(isset($_SESSION['blad'])) {
                    echo $_SESSION['blad'];
                    }
                ?>
            </div>
            <div style="clear:both;"></div>
        </div>
    </body>
</html>
