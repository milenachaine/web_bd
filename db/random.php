<?php
require_once("fonctions.php");

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
  echo "Erreur de connexion à la base de données ".$e->getMessage();
  die();
}

$rq = "SELECT * FROM Ressources ORDER BY RAND() LIMIT 1;";
$requete = $sql->prepare($rq);
$res = $requete->execute();
while($ligne = $requete->fetch(PDO::FETCH_OBJ)) {
    liste_puces($ligne);
}

?>
