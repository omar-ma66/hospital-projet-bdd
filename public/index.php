<?php
session_unset();
session_start();
$datas = null;
$fields = null;
$result = null;
$nbLines = null;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Exercice1 Afficher tous les clients</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css">
</head>

<body>
    <h1>PDO Exercice1 HOSPITALE </h1>

    <a href="templates/ajouter-patient.php">Ajouter Patient</a>
    <a href="templates/liste-patients.php">Liste Patients</a>
    <a href="templates/ajout-rendezvous.php">Ajout RDV</a>
    <a href="templates/liste-rendezvous.php">Liste RDV</a>

</body>

</html>