<?php 
  session_start(); 

  if(!isset($_SESSION['zalogowany'])) {
    header('Location:index.php');
    exit();
  }
?>

<?php

$slowo = "";
$losowa = rand(0, 1520164);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisielec";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT slowo FROM words WHERE id = $losowa";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $slowo = $row["slowo"];
  }
} else {
  echo "0 results";
}

$conn->close();
?>

<script>
    //TODO
    var word = <?php echo json_encode($slowo); ?>;
    word = word.slice(0, -1);
</script>

<!DOCTYPE html>
<html lang = "pl">
    <head>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;700&display=swap" rel="stylesheet">
        <title>Wisielec - Karolina Stopa, Kamil Słoczyński, Jakub Moniakowski</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
        <script src="wisielec.js"></script>
    </head>
    <body onselectstart="return false" onselect="return false" oncopy="return false">
        <?php echo "Zalogowano jako: " . $_SESSION['user'] . "<br/> Twoje wygrane gry: " . $_SESSION['wygrane'] . "<br/> Twoje przegrane gry: " . $_SESSION['przegrane'] . '<br/><br/><a href="logout.php">Wyloguj</a>'; ?>
        <div id="container">
            <div id="haslo">
                
            </div>
            <div id ="szubienica">
                <img src="img/s0.jpg" alt="" />
            </div>
            <div id ="litery">
                
            </div>
            <div style="clear:both;"></div>
        </div>
    </body>
</html>
