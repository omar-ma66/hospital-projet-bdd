<?php
session_start();
$idpatient = null;

if ($_SERVER["REQUEST_METHOD"] !== "POST")
    header("location:../templates/ajout-rendezvous.php?server-erreur=no-post-method");
if (!isset($_POST["datehour"]) || empty($_POST["datehour"]))
    header("location:../templates/ajout-rendezvous.php?server-erreur=datehour-probleme");
if (!isset($_SESSION["idpatient"]) || empty($_SESSION["idpatient"]))
    header("location:../templates/ajout-rendezvous.php?server-erreur=session-probleme");
if (!isset($_POST["idpatient"]) || empty($_POST["idpatient"]))
    header("location:../templates/ajout-rendezvous.php?server-erreur=id-probleme");

$idpatient = intval(htmlspecialchars($_POST['idpatient']));

if ($_SESSION["idpatient"] !== $idpatient)
    header("location:../templates/ajout-rendezvous.php?server-erreur=id-probleme-noequal");

$dateHourTmp = explode('T', $_POST["datehour"]);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDV</title>
    <link rel="stylesheet" href="../css/rdv.css" type="text/css">
</head>

<body>
    <h1>PDO Exercice ajout RDV </h1>
    <a href="../index.php">Acceuil</a>
    <?php
    require("../../src/PDOconnect.php");
    $idcon = PDOconnect("param", "hospitale2n");
    $datehour = $dateHourTmp[0] . " " . $dateHourTmp[1];
    $query = "INSERT INTO appointments(datehour,patient_id)VALUES( :datehour ,:patient_id)";
    $reqpreparer = $idcon->prepare($query);
    $data = [
        "datehour" => $datehour,
        "patient_id" => $idpatient
    ];
    $reqpreparer->execute($data);
    $idcontrole = $idcon->lastInsertId();
    if ($idcon->lastInsertId() === false) {
        $idcon = null;
        header("location:../templates/ajout-rendezvous.php?server-erreur=insert-erreur");
    } else {
        $idcon = null;
        header("location:../templates/ajout-rendezvous.php?server-erreur=insert-ok=$idcontrole");
    }

    ?>

</body>

</html>