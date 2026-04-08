<?php
session_start();
$message;
if (isset($_GET["serveur-erreur"])) {
  $message = "Une erreur c'est produite : " . $_GET["serveur-erreur"];
}
if (isset($_GET["serveur-message"])) {
  $message = "l'enregistrement c'est bien éffectué votre ID => " . $_GET["serveur-message"];
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter Patient</title>
  <link rel="stylesheet" href="../css/ajouter-patients.css" type="text/css">
</head>

<body>
  <h1>PDO Exercice Ajouter patient</h1>

  <?php if (isset($message)): ?>
    <span> <?= $message ?></span>
  <?php endif; ?>

  <form method="post" action="../bdd/ajouter.php">
    <fieldset>
      <legend>Information patient</legend>
      <label for="id_lastname">LastName</label>
      <input type="text" id="id_lastname" name="lastname" minlength="3" required><br>
      <label for="id_firstname">FirstName</label>
      <input type="text" id="id_firstname" name="firstname" minlength="3" required><br>
      <label for="id_birthdate">BirthDay</label>
      <input type="date" id="id_birthdate" name="birthdate" required><br>
      <label for="id_phone">Phone</label>
      <input type="tel" id="id_phone" name="phone" required><br>
      <label for="id_mail">Mail</label>
      <input type="email" id="id_mail" name="mail" required>
    </fieldset>
    <fieldset>
      <input type="submit" value="ENVOYER">&nbsp;&nbsp;&nbsp; <input type="reset" value="EFFACER">
    </fieldset>
  </form>

  <a href="../index.php">Accueil</a>
</body>

</html>