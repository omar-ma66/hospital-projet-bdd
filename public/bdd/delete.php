<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    header("location:../templates/liste-rendezvous.php?serveur-erreur=method-erreur");
}
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("location:../templates/liste-rendezvous.php?serveur-erreur=method-erreur");
}
$id = intval(htmlspecialchars($_GET["id"]));

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
    <link rel="stylesheet" href="../css/delete.css" type="text/css">
</head>

<body>
    <h1>PDO Exercice Delete</h1>
    <a href="../index.php">Accueil</a>
    <a href="../templates/liste-rendezvous.php">liste RDV</a>

    <?php
    require("../../src/PDOconnect.php");
    $idcon = PDOconnect("param", "hospitale2n");

    $query = "DELETE FROM appointments WHERE id = :idrdv";

    $reqPreparer =   $idcon->prepare($query);
    $dataPreparer = ["idrdv" => $id];
    if ($reqPreparer->execute($dataPreparer))
        header("location:../templates/liste-rendezvous.php?serveur-info=supprimer");
    else
        header("location:../templates/liste-rendezvous.php?serveur-erreur=non-supprimer");
    ?>

</body>

</html>