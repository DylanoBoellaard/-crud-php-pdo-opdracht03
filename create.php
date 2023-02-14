<?php
/**
 * We gaan een verbinding maken met de MySQL database
 */
require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo 'Er is een verbinding gemaakt met de mysqldatabase';
    } else {
        echo 'Interne servererror, neem contact op met de databasebeheerder';
    }
} catch(PDOException $e) {
    echo $e->getMessage();
}

$post = var_dump($_POST);

/**
 * We gaan een sql-query maken voor het wegschrijven van de formuliergegevens in de tabel Persoon
 */
// Schrijf de sql-insertquery
$sql = "INSERT INTO achtbaan (Id
                            ,NaamAchtbaan
                            ,NaamPretpark
                            ,Land
                            ,Topsnelheid
                            ,Hoogte
                            ,Datum
                            ,Cijfer)
        VALUES              (NULL
                            ,:achtbaan
                            ,:pretpark
                            ,:land
                            ,:topsnelheid
                            ,:hoogte
                            ,:datum
                            ,:cijfer);";

// Maak de sql-query gereed om te worden afgevuurd op de mysql-database
$statement = $pdo->prepare($sql);

// De bindValue method bind de $_POST waarde aan de placeholder
$statement->bindValue(':achtbaan', $_POST['NaamAchtbaan'], PDO::PARAM_STR);
$statement->bindValue(':pretpark', $_POST['NaamPretpark'], PDO::PARAM_STR);
$statement->bindValue(':land', $_POST['Land'], PDO::PARAM_STR);
$statement->bindValue(':topsnelheid', $_POST['Topsnelheid'], PDO::PARAM_STR);
$statement->bindValue(':hoogte', $_POST['Hoogte'], PDO::PARAM_STR);
$statement->bindValue(':datum', $_POST['Datum'], PDO::PARAM_STR);
$statement->bindValue(':cijfer', $_POST['Cijfer'], PDO::PARAM_STR);

// Voer de sql-query uit op de database
$statement->execute();

echo "Het opslaan is gelukt";
// Link door naar read.php voor een overzicht van de gegevens in tabel Persoon
header('Refresh:4; url=read.php');