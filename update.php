<?php
require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "Verbinding";
    } else {
        // echo "Interne error";
    }
} catch(PDOException $e) {
    $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Er is op het formulier knopje gedrukt";
    var_dump($_POST);
    try {
        $sql = "UPDATE achtbaan
                SET NaamAchtbaan = :achtbaan,
                    NaamPretpark = :pretpark,
                    Land = :land,
                    Topsnelheid = :topsnelheid,
                    Hoogte = :hoogte,
                    Datum = :datum,
                    Cijfer = :cijfer

                WHERE Id = :Id";

        $statement = $pdo->prepare($sql);
        $statement->bindValue(':Id', $_POST['id'], PDO::PARAM_INT);
        $statement->bindValue(':achtbaan', $_POST['achtbaan'], PDO::PARAM_STR);
        $statement->bindValue(':pretpark', $_POST['pretpark'], PDO::PARAM_STR);
        $statement->bindValue(':land', $_POST['land'], PDO::PARAM_STR);
        $statement->bindValue(':topsnelheid', $_POST['topsnelheid'], PDO::PARAM_STR);
        $statement->bindValue(':hoogte', $_POST['hoogte'], PDO::PARAM_STR);
        $statement->bindValue(':datum', $_POST['datum'], PDO::PARAM_STR);
        $statement->bindValue(':cijfer', $_POST['cijferR'], PDO::PARAM_STR);

        $statement->execute();

        header('Refresh:3; url=read.php');
    } catch(PDOException $e) {
        echo 'Het record is niet geupdate, probeer het opnieuw.'; 
        header('Refresh:3; url=read.php');
    }
    exit();
} 

$sql = "SELECT Id
              ,NaamAchtbaan as NA
              ,NaamPretpark as NP
              ,Land as LA
              ,Topsnelheid as TS
              ,Hoogte as HO
              ,Datum as DA
              ,Cijfer as CI
        FROM achtbaan
        WHERE Id = :Id";

$statement = $pdo->prepare($sql);

$statement->bindValue(':Id', $_GET['id'], PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetch(PDO::FETCH_OBJ);

var_dump($result);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht03 PDO-CRUD</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Invoer achtbaan</h2>

    <a href="read.php">Achtbanen lijst</a>
    <form action="update.php" method="post">
        <label for="achtbaan">Naam achtbaan:</label><br>
            <input type="text" id="achtbaan" name="achtbaan" value="<?= $result->NA ?>">
        <br>
        <br>
        <label for="pretpark">Naam pretpark:</label><br>
            <input type="text" id="pretpark" name="pretpark" value="<?= $result->NP ?>">
        <br>
        <br>
        <label for="land">Naam Land:</label><br>
            <input type="text" id="land" name="land" value="<?= $result->LA ?>">
        <br>
        <br>
        <label for="topsnelheid">Topsnelheid (km/h):</label><br>
            <input type="number" id="topsnelheid" name="topsnelheid" min="1" max="200" value="<?= $result->TS ?>">
        <br>
        <br>
        <label for="hoogte">Hoogte (m):</label><br>
            <input type="number" id="hoogte" name="hoogte" min="1" max="200" value="<?= $result->HO ?>">
        <br>
        <br>
        <label for="datum">Datum eerste opening:</label><br>
            <input type="date" id="datum" name="datum" value="<?= $result->DA ?>">
        <br>
        <br>
        <label for="cijfer">Cijfer voor achtbaan:</label><br>
            <input type="range" id="cijferR" name="cijferR" min="1" max="10" step="0.1">
            <input type="number" id="cijferN" name="cijferN" min="1" max="10" step="0.1" value="<?= $result->CI ?>">
        <br>
        <br>
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <input type="submit" value="Submit">
    </form>

    <script src="script.js"></script>
</body>
</html>