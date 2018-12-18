<?php
require_once("../fonctions.php");
 $date = date("d/m/y");
 $heure = date("H:i");

 echo $date."\n".$heure;

 // Définition des paramètres

$serveur = "localhost";
$bd = "BaseRessources";
$login = "root";
$mdp = "root";

// Gestion des erreurs
try {
    // Connexion à MySQL avec affichage des résultats en UTF-8
    $sql = new PDO('mysql:host='.$serveur.';dbname='.$bd, $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

catch(PDOException $e) {
     echo "Erreur de connexion à la base de données " . $e->getMessage();
     die();
}

$rq = "SELECT Ressources.* FROM Ressources, ResJoinPltfrm, Plateformes WHERE Ressources.ID = ResJoinPltfrm.RES AND Plateformes.ID = ResJoinPltfrm.PLTFRM AND Plateformes.ID = :pltfrm;";
$requete2 = $sql->prepare($rq);
$requete2->bindParam(':pltfrm',$_GET['pltfrm']);
$res = $requete2->execute();
while($ligne = $requete2->fetch(PDO::FETCH_OBJ)) {
    liste_puces($ligne);
}
