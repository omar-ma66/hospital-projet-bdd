<?php
// corrige l'injection
session_start();
$datas;
$fields;

if (!$_SERVER["REQUEST_METHOD"] === "POST")
    header("location:liste-patients?serveur-erreur=no-post-method");
if (!isset($_POST["profile"]) || empty($_POST["profile"]))
    header("location:liste-patients?serveur-erreur=information-probleme");

$idPatient = intval(htmlspecialchars($_POST["profile"]));
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/profil-patient.css" type="text/css">
</head>

<body>
    <h1>PDO Exercice profil-patient</h1>
    <a href="liste-patients">Liste patient</a>
    <!-- <a href="liste-rendezvous.php">Liste RDV</a> -->

    <?php

    require("../../src/PDOconnect.php");
    $idcon = PDOconnect("param", "hospitale2n");
     $query = "SELECT patients.id,lastname,firstname,birthdate,phone,mail,datehour FROM patients,appointments where patients.id=$idPatient and appointments.patient_id=$idPatient";
   // $query = "SELECT * FROM patients,appointments where patients.id=$idPatient and appointments.patient_id=$idPatient";
    $result = $idcon->query($query);

    if ($result->rowCount() === 0) {
        // $mesErreurs = $idcon->errorInfo();
        // echo "Une erreur c'est produite " . $idcon->errorCode() . " : " . $mesErreurs[2] . " <br> ";
        header("location:liste-patients?serveur-erreur=information-probleme");
    } else {
        $datas    =         $result->fetch(PDO::FETCH_ASSOC);
        $fields  = array_keys($datas);
        $result->closeCursor();
    }
    $idcon = null;
    ?>
    <!--  faire le tableau  -->
    <?php if ($datas) : ?>

        <table>
            <tr>
                <?php foreach ($fields as $field) : ?>
                    <th> <?= $field ?></th>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($datas as $data) : ?>
                    <td> <?= $data ?></td>
                <?php endforeach; ?>
            </tr>

        </table>
    <?php endif; ?>

<!-- ----------------------------------------------------------------------------------------------- -->

    <form method="post" action="../bdd/update.php">
        <fieldset>
            <legend>Mise a jour profile patient </legend>
            <label for="id_patient">id patient:</label>
            <input type="number" id="id_patient" value="<?= $datas["id"] ?>" name="idpatient" readonly> <br>

            <label for="id_lastname">lastname:</label>
            <input type="text" id="id_lastname" value="<?= $datas["lastname"] ?>" name="lastname"> <br>

            <label for="id_firstname">firstname:</label>
            <input type="text" id="id_firstname" value="<?= $datas["firstname"] ?>" name="firstname"> <br>

            <label for="id_birthdate">birthdate:</label>
            <input type="date" id="id_birthdate" value="<?= $datas["birthdate"] ?>" name="birthdate"> <br>

            <label for="id_phone">phone:</label>
            <input type="tel" id="id_phone" value="<?= $datas["phone"] ?>" name="phone"> <br>

            <label for="id_mail">mail:</label>
            <input type="email" id="id_mail" value="<?= $datas["mail"] ?>" name="mail"> <br>

            <label for="id_datehour">datehour:</label>
            <input type="text" id="id_datehour" value="<?= $datas["datehour"] ?>" name="datehour" readonly> <br>
        </fieldset> 

        <fieldset>
            <input type="submit" value="mise a jour">
        </fieldset>
    </form>
<!-- ----------------------------------------------------------------------------------------------- -->

</body>

</html>