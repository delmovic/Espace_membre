<?php

$host="localhost";
$login="root";
$mdp="";
try{

$connexion= new PDO("mysql:host=$host;dbname=membres",$login,$mdp);
$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

 
}
catch(PDOException $e){
echo 'Echec de connexion a la base'.$e->getMessage();

}

?>

  
