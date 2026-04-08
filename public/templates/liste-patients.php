<?php
session_start();
$idcon = null;
$result = null;
$nbLine = null;
$fields = null;
$datas  = null;
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/liste-patients.css" type="text/css">
    <title>Liste patients</title>
</head>

<body>
    <h1>PDO Exercice Liste patients</h1>
    <?php
    require ("../../src/PDOconnect.php");
    $idcon = PDOconnect("param", "hospitale2n");

    $query = "SELECT * FROM patients";

    $result = $idcon->query($query);

    if (!$result) {
        $mesErreurs = $idcon->errorInfo();
        echo "une erreur c'est produite " . $idcon->errorCode() . " : " . $mesErreurs[2] . "<br>";
    } else {
        $nbLine     = $result->rowCount();
        $datas      = $result->fetchAll(PDO::FETCH_ASSOC);
        $fields     = array_keys($datas[0]);

        $result->closeCursor();
    }
    $idcon = null;

    ?>
 <a href="../index.php">Acceuil</a>
 <a href="profil-patient.php">Profil-patient</a>

<!-- ------------------------------------------------------------------------------------------ -->
 <form method="post" action="profil-patient.php">
    <fieldset>
        <legend>profil-patient</legend>
        <label for="id_patient">ID patient</label>
        <input type="number" id="id_patient" name="profile">
        
        <input type="submit" value="INFO PROFIL">
    </fieldset>
 </form>
<!----------------------------------------------------------------------------------------------- -->
    <table>
        <tr>
            <?php foreach ($fields as $field) : ?>
                <th><?= $field ?></th>
            <?php endforeach; ?>
        </tr>

        <?php foreach ($datas as  $data): ?>
            <tr>
                <?php foreach ($data as $value): ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>

    </table>

<!----------------------------------------------------------------------------------------------- -->
</body>

</html>