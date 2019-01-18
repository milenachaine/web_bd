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

$req = $sql->prepare('INSERT INTO Ressources (LIEN, NOM, LANGAGE) VALUES(:url, :name, :expl)');
try {
    // Définition des paramètres
    $req->bindParam(':url', $_GET['url']);
    $req->bindParam(':name', $_GET['name']);
    $req->bindParam(':expl', $_GET['expl']);
    // Exécution de la requête
    $resultat = $req->execute();
    if($resultat) {
        echo "Enregistrement réussi";
    }
    else {
      echo ":(";
    }
}

catch( Exception $e ){
    echo 'Erreur de requête : ', $e->getMessage();
}
?>
