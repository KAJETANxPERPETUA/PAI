<?php

    session_start();

    require_once "connect.php";

    if(isset($_POST['nick'])) {
        $wszystkoOk = true;

        $nick = $_POST['nick'];
        if((strlen($nick) < 3) || (strlen($nick) > 20)) {
            $wszystkoOk = false;
            $_SESSION['e_nick'] = "zły nick";
        }

        if(ctype_alnum($nick)==false) {
            $wszystkoOk = false;
            $_SESSION['e_nick'] = "zły nick ";
        }

        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];

        if((strlen($haslo1) < 6) || (strlen($haslo1) > 20)) {
            $wszystkoOk = false;
            $_SESSION['e_haslo'] = "złe hasło";
        }

        if($haslo1 != $haslo2) {
            $wszystkoOk = false;
            $_SESSION['e_haslo'] = "hasła nie są identyczne";
        }

        if(!isset($_POST['comicsans'])) {
            $wszystkoOk = false;
            $_SESSION['e_checkbox'] = "nie potwierdzono cudowności comic sans!";
        }

        //baza danych
        mysqli_report(MYSQLI_REPORT_STRICT);
        try {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

            if($polaczenie->connect_errno != 0) {
                throw new Exception(mysqli_connect_errno());
            }
            else {
                //czy nazwa figuruje już w bazie
                $result = $polaczenie->query("SELECT id FROM players WHERE user = '$nick'");
                
                if(!$result) throw new Exception($polaczenie->error);

                $iletakichnickow = $result->num_rows;
                if($iletakichnickow > 0) {
                    $wszystkoOk = false;
                    $_SESSION['e_baza_nick'] = "ktoś już zarejestrował taki nick!";
                }

                if($wszystkoOk == true) {
                    //dodanie do bazy
                    if($polaczenie->query("INSERT INTO players VALUES (NULL, '$nick', '$haslo1', 0, 0, 0)")) {
                        $_SESSION['udanarejestracja']=true;
                        header('Location: welcome.php');
                    }
                    else {
                        throw new Exception($polaczenie->error);
                    }
                    
                }

                $polaczenie->close();
            }

        }
        catch(Exception $e) {
            echo '<span style="color:red">Ełłoł!</span>';
        }
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
            <form method="post">
                Login:<br/> <input type="text" name="nick" placeholder="3-20 znaków" /><br/>
                <?php 
                if(isset($_SESSION['e_nick'])){
                    echo '<div class="error">' . $_SESSION['e_nick'].'</div>';
                    unset($_SESSION['e_nick']);
                }
                ?>
                Hasło:<br/> <input type="password" name="haslo1" placeholder="6-20 znaków" /><br/>
                <?php 
                if(isset($_SESSION['e_haslo'])){
                    echo '<div class="error">' . $_SESSION['e_haslo'].'</div>';
                    unset($_SESSION['e_haslo']);
                }
                ?>
                Powtórz hasło:<br/> <input type="password" name="haslo2" placeholder="powtórz hasło"/><br/>
                <label>
                <br/><input type="checkbox" name="comicsans"/> Potwierdzam, że Comic Sans to najlepsza czcionka na świecie!</label> 
                <?php 
                if(isset($_SESSION['e_checkbox'])){
                    echo '<div class="error">' . $_SESSION['e_checkbox'].'</div>';
                    unset($_SESSION['e_checkbox']);
                }
                ?>
                <input type="submit" value="Utwóz konto">
                <?php 
                if(isset($_SESSION['e_baza_nick'])){
                    echo '<div class="error">' . $_SESSION['e_baza_nick'].'</div>';
                    unset($_SESSION['e_baza_nick']);
                }
                ?>
            </form>
            <br/><br/><a href="index.php">Powrót do logowania</a>
        </div>
    </body>
</html>
