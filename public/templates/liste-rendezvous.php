<?php
// terminer le code 
session_start();


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste RDV</title>
    <link rel="stylesheet" href="../css/liste-rendezvous.css" type="text/css">
</head>
<body>
    <h1>PDO Exercice Liste RDV</h1>
    <a href="ajout-rendezvous.php">ajout rendez vous</a>

 <?php
    require("../../src/PDOConnect.php");
    $idcon = PDOconnect("param","hospitale2n");

    $query = "SELECT id FROM appointments WHERE patient_id=:idpatient";

    $requetprepare = $idcon->prepare($query);
    $data = ["patient_id"=>$idpatient];
    $requetprepare->execute($data);
 ?>

</body>
</html>