<?php
function PDOconnect($param,$base)
{
    require($param.".inc.php");
    $dsn = "mysql:host=".HOST.";dbname=".$base.";charset=utf8mb4" ;
    $user = USER ;
    $pass = PASS ;
$options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
            PDO::ATTR_EMULATE_PREPARES => false
            ];

            try{
                    $idcon = new PDO($dsn,$user,$pass,$options); 
                    return $idcon ;
            }catch(PDOException $errpdo)
            {
            echo "fichier :",$errpdo->getFile()."<br>";
            echo "ligne   :",$errpdo->getLine()."<br>";
            echo "message :",$errpdo->getMessage()."<br>";
            echo "code    :",$errpdo->getCode()."<br>" ;
            }
    }