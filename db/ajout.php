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

entete("Milena Chaîne - Web/BD", "utf-8", "../stylesheets/style.css","Milena Chaîne","projet web/bd", "php", "bipbip@gmail.com");
debut("Résultat de la demande d'ajout");

//requête d'insertion d'élément dans la table Ressources (simplifié pour ne pas devoir gérer les tables de jointures)
$req = $sql->prepare('INSERT INTO Ressources (LIEN, NOM, LANGAGE) VALUES(:url, :name, :expl)');
try {
    // Définition des paramètres
    $req->bindParam(':url', $_GET['url']);
    $req->bindParam(':name', $_GET['name']);
    $req->bindParam(':expl', $_GET['expl']);
    // Exécution de la requête
    $resultat = $req->execute();
    //on renvoie juste un message d'erreur ou de réussite
    if($resultat) {
        echo "La demande d'ajout a été prise en compte !";
    }
    else {
      echo "Il y a un problème avec le formulaire ; la requête n'a pas été prise en compte.";
    }
}

catch( Exception $e ){
    echo 'Erreur de requête : ', $e->getMessage();
}
retour("ajout.html");
fin();
?>
