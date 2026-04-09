<?php
session_start();
$isExistPatient = false;
$fields = null;
$datas  = null;
$idpatient = null;
if (isset($_POST["idpatient"]) && !empty($_POST["idpatient"])) {
  $idpatient = intval($_POST["idpatient"]);
  require("../../src/PDOconnect.php");
  $idcon = PDOconnect("param", "hospitale2n");

  $query = "SELECT * FROM patients where id = :id";

  $reqprepare = $idcon->prepare($query);

  $data = ["id" => $idpatient];

  if ($reqprepare->execute($data)) {
    if ($datas =  $reqprepare->fetch(PDO::FETCH_ASSOC)) {
      $fields = array_keys($datas);
      $isExistPatient = true;
      $reqprepare->closeCursor();
      $_SESSION["idpatient"] = $idpatient;
    }
  }

  $idcon = null;
}
?>
<!----------------------------------------------------------------------------------------------  -->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rendezvous</title>
  <link rel="stylesheet" href="../css/ajout-rendezvous.css" type="text/css">
</head>

<body>
  <h1>PDO Exercice Ajout RDV</h1>
  <a href="../index.php">Acceuil</a>
  <!----------------------------------------------------------------------------------------------  -->
  <form method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
    <fieldset>
      <legend>patient</legend>
      <label for="id_patient">ID</label>
      <input type="number" name="idpatient" id="id_patient">
    </fieldset>
    <input type="submit" value="RECHERCHE PATIENT">
  </form>
  <!----------------------------------------------------------------------------------------------  -->

  <?php if ($isExistPatient) : ?>
    <!----------------------------------------------------------------------------------------------  -->
    <form method="post" action="../bdd/rdv.php">
      <fieldset>
        <legend>patient</legend>
        <label for="id_patient">ID</label>
        <input type="number" name="idpatient" id="id_patient" readonly value="<?= $idpatient ?>"><br>

        <label for="id_firstname">firstname</label>
        <input type="text" name="firstname" id="id_firstname" readonly value="<?= $datas["firstname"] ?>"><br>

        <label for="id_lastname">lastname</label>
        <input type="text" name="lastname" id="id_lastname" readonly value="<?= $datas["lastname"] ?>"><br>

        <label for="id_birthdate">birthdate</label>
        <input type="date" name="birthdate" id="id_birthdate" readonly value="<?= $datas["birthdate"] ?>"><br>

        <label for="id_phone">phone</label>
        <input type="tel" name="phone" id="id_phone" readonly value="<?= $datas["phone"] ?>"><br>

        <label for="id_mail">mail</label>
        <input type="mail" name="mail" id="id_mail" readonly value="<?= $datas["mail"] ?>"><br>

      </fieldset>

      <fieldset>

        <label for="id_datehour">datehour</label>
        <input type="datetime-local" name="datehour" id="id_datehour" required><br>
      </fieldset>
      <input type="submit" value="AJOUTER RDV">
    </form>
    <!----------------------------------------------------------------------------------------------  -->

  <?php endif; ?>

</body>

</html>