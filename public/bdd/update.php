<?php
session_start();
$idpatien  = null ;
$lastname = null;
$firstname = null;
$birthdate = null;
$phone    = null;
$mail     = null;
$reponse  = null;
$info     = null;


if($_SERVER["REQUEST_METHOD"] !== "POST")
    header("location:../templates/profil-patients.php?serveur-erreur=no-post-method");
if(!isset($_POST["lastname"]) || empty($_POST["lastname"]))
    header("location:../templates/profil-patients.php?serveur-erreur=lastname-erreur");
if(!isset($_POST["firstname"]) || empty($_POST["firstname"]))
    header("location:../templates/profil-patients.php?serveur-erreur=firstname-erreur");
if(!isset($_POST["birthdate"]) || empty($_POST["birthdate"]))
    header("location:../templates/profil-patients.php?serveur-erreur=birthdate-erreur");
if(!isset($_POST["phone"]) || empty($_POST["phone"]))
    header("location:../templates/profil-patients.php?serveur-erreur=phone-erreur");
if(!isset($_POST["mail"]) || empty($_POST["mail"]))
    header("location:../templates/profil-patients.php?serveur-erreur=mail-erreur");
// if(!isset($_POST["datehour"]) || empty($_POST["datehour"]))
//     header("location:../templates/profil-patients.php?serveur-erreur=datehour-erreur");

$idpatient  = intval(htmlspecialchars($_POST["idpatient"]));
$lastname   = htmlspecialchars($_POST["lastname"]);
$firstname  = htmlspecialchars($_POST["firstname"]);
$birthdate  = htmlspecialchars($_POST["birthdate"]);
$phone      = htmlspecialchars($_POST["phone"]);
$mail       = htmlspecialchars($_POST["mail"]);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update.php</title>
    <link rel="stylesheet" href="../css/update.css" type="text/css">
</head>
<body>
    <h1>PDO Exercice Update</h1>

<?php
        require("../../src/PDOconnect.php");
        $idcon = PDOconnect("param","hospitale2n");

     $query = "UPDATE patients SET lastname=:lastname , firstname=:firstname , birthdate=:birthdate ,phone=:phone ,mail=:mail WHERE id=$idpatient";   
$reqprepare =  $idcon->prepare($query);

$data= [
    "lastname"=>$lastname, 
    "firstname"=>$firstname,
    "birthdate"=>$birthdate,
    "phone" =>$phone,
    "mail" =>$mail];

 $reponse =  $reqprepare->execute($data);   

                    if($reponse)
                        {
    // header("location:../templates/profil-patients.php?serveur-reponse=update-ok"); 
    $info = "Les données sont  a jour ";       
                        }
                     else
                        {
    // header("location:../templates/profil-patients.php?serveur-erreur=update-false");        
    $info = "Problème : les données ne son pas mise a jour ";
                        }   
    $idcon = null;
?>

<a href="../templates/profil-patient.php">Profil patient</a>
<a href="../templates/liste-patients.php">Liste patients</a>
<a href="ajouter.php">Ajouter patient</a>
<a href="../index.php">Acceuil</a>

            <?php if($reponse) : ?>
                    <div class="boite-alert">
                         <span><?= $info ?></span>
                    </div>         
            <?php endif;?>    


</body>
</html>