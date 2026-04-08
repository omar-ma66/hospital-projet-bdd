<?php
// alt z
session_start();
$id = null;
$idcon = null;


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location:../templates/ajouter-patient.php?serveur-erreur=nopost-method");
}
if (!isset($_POST["lastname"]) || empty($_POST["lastname"])) {
    header("location:../templates/ajouter-patient.php?serveur-erreur=no-lastname");
}
if (!isset($_POST["firstname"]) || empty($_POST["firstname"])) {
    header("location:../templates/ajouter-patient.php?serveur-erreur=no-firstname");
}
if (!isset($_POST["birthdate"]) || empty($_POST["birthdate"])) {
    header("location:../templates/ajouter-patient.php?serveur-erreur=no-birthday");
}
if (!isset($_POST["phone"]) || empty($_POST["phone"])) {
    header("location:../templates/ajouter-patient.php?serveur-erreur=no-phone");
}
if (!isset($_POST["mail"]) || empty($_POST["mail"])) {
    header("location:../templates/ajouter-patient.php?serveur-erreur=no-mail");
}

require "../../src/PDOconnect.php";
$idcon = PDOconnect("param", "hospitale2n");

$idcon->beginTransaction();

if (!$idcon->inTransaction()) {
    $idcon = null;
    header("location:../templates/ajouter_patient?serveur-erreur=no-transaction");
}


$firstname      = htmlspecialchars($_POST["firstname"]);
$lastname       = htmlspecialchars($_POST["lastname"]);
$phone            = htmlspecialchars($_POST["phone"]);
$birthdate      = htmlspecialchars($_POST["birthdate"]);
$mail           = htmlspecialchars($_POST["mail"]);

$query = "INSERT INTO patients ( lastname,firstname,birthdate,phone,mail) VALUE(:lastname, :firstname, :birthdate,:phone,:mail) ";

$reqprepare =  $idcon->prepare($query);

$data = [
    'lastname'  =>  $lastname,
    'firstname' =>  $firstname,
    'birthdate' =>  $birthdate,
    'phone'     =>  $phone,
    'mail'      =>   $mail
];
$action = $reqprepare->execute($data);
$id = $idcon->lastInsertId();
/* -------------------------------------------- */

$query2 = "INSERT INTO appointments( datehour,patient_id) VALUE(NOW(), $id) ";
$action += $idcon->exec($query2);

if ($action === 2) {
    $idcon->commit();
    header("location:../templates/ajouter-patient.php?serveur-message=$id");
} else {
    $idcon->rollBack();
    header("location:../templates/ajouter-patient.php?serveur-erreur=transaction-rollBack");
}

//    $reqprepare = $idcon->prepare($query2) ;
//  $reqprepare->execute(["datehour"=>$date->format("Y-m-d H:I:s")]);
/* -------------------------------------------- */
