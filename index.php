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
    <form action="create.php" method="post">
        <label for="achtbaan">Naam achtbaan:</label><br>
            <input type="text" id="achtbaan" name="achtbaan">
        <br>
        <br>
        <label for="pretpark">Naam pretpark:</label><br>
            <input type="text" id="pretpark" name="pretpark">
        <br>
        <br>
        <label for="land">Naam Land:</label><br>
            <input type="text" id="land" name="land">
        <br>
        <br>
        <label for="topsnelheid">Topsnelheid (km/h):</label><br>
            <input type="number" id="topsnelheid" name="topsnelheid" min="1" max="200">
        <br>
        <br>
        <label for="hoogte">Hoogte (m):</label><br>
            <input type="number" id="hoogte" name="hoogte" min="1" max="200">
        <br>
        <br>
        <label for="datum">Datum eerste opening:</label><br>
            <input type="date" id="datum" name="datum">
        <br>
        <br>
        <label for="cijfer">Cijfer voor achtbaan:</label><br>
            <input type="range" id="cijferR" name="cijferR" min="1" max="10" step="0.1">
            <input type="number" id="cijferN" name="cijferN" min="1" max="10" step="0.1" value="5">
        <br>
        <br>

        <input type="submit" value="Submit">
    </form>

    <script src="script.js"></script>
</body>
</html>