<?php
// terminer le code 
session_start();


?>
<!-- -------------------------------------------------------------------------------------------- -->
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
    <!-- -------------------------------------------------------------------------------------------- -->

    <!-- -------------------------------------------------------------------------------------------- -->
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <fieldset>
            <legend>Id patient</legend>
            <label for="id_patient">ID PATIENT</label>
            <input type="number" name="idpatient" id="id_patient"> <br>
        </fieldset>
        <fieldset>
            <input type="submit" value="RECHERCHER PATIENT">
        </fieldset>
    </form>
    <!-- -------------------------------------------------------------------------------------------- -->
    <?php
    $datas = null;
    $fields = null;
    $result = null;
    $idcon = null;
    $idpatient = null;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["idpatient"]) && !empty($_POST["idpatient"])) {
            $idpatient = intval(htmlspecialchars($_POST["idpatient"]));

            require("../../src/PDOConnect.php");
            $idcon = PDOconnect("param", "hospitale2n");
            $query = "SELECT * FROM patients WHERE id = :patient ";
            $reqprepare = $idcon->prepare($query);
            $dataPrepare = ["patient" => $idpatient];

            $reqprepare->execute($dataPrepare);

            if ($reqprepare->rowCount() == 1) {
                $datas = $reqprepare->fetch(PDO::FETCH_ASSOC);
                $fields = array_keys($datas);
                // $reqprepare->closeCursor();
                // $idcon = null;
            } else {
                $idcon = null;
                header("location:{$_SERVER["PHP_SELF"]}?serveur-erreur=id-inconu");
            }
        }
    }
    ?>
    <!-- -------------------------------------------------------------------------------------------- -->
   
    <?php if ($datas) : ?>
        <table>
            <tr>
                <?php foreach ($fields as $field) : ?>
                    <th> <?= $field ?> </th>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($datas as $data) : ?>
                    <th> <?= $data ?> </th>
                <?php endforeach; ?>
            </tr>
        </table>
    <?php endif; ?>


    <!-- -------------------------------------------------------------------------------------------- -->

    <?php
    $dataRdv = null;
    $row     = null;
    // $idcon   = null ;
    if ($idpatient && $datas) {
        // require("../../src/PDOConnect.php");
        // $idcon = PDOconnect("param", "hospitale2n");
        $query = "SELECT datehour FROM appointments WHERE patient_id=:id_patient ";
        $reqprepare = $idcon->prepare($query);
        $dataPrepare = ["id_patient" => $idpatient];
        $reqprepare->execute($dataPrepare);

        if ($reqprepare->rowCount() > 0) {
            $dataRdv = $reqprepare->fetchAll(PDO::FETCH_NUM);
            $row   =   $reqprepare->rowCount();
            $reqprepare->closeCursor();
            $idcon = null;
        }
    }
    ?>
    <!-- -------------------------------------------------------------------------------------------- -->

    <?php if ($dataRdv && $row) : ?>
        <table>
            <tr>
                <th>Date de vos RDV</th>
            </tr>

            <?php foreach ($dataRdv as $rdv) : ?>
                <tr>
                    <?php foreach ($rdv as $val) : ?>
                        <td><?= $val ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <!-- -------------------------------------------------------------------------------------------- -->


</body>

</html>