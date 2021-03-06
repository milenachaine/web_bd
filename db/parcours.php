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
debut("Résultat de la recherche");

//la requête consiste à récupérer ce que l'utilisateur a tapé et le chercher sans contexte dans la table Ressources
$rq = "SELECT Ressources.NOM, Ressources.EXPL, Ressources.URL FROM Ressources WHERE Ressources.NOM LIKE CONCAT('%',:terme, '%') OR Ressources.URL LIKE CONCAT('%',:terme, '%') OR Ressources.EXPL LIKE CONCAT('%',:terme, '%');";
$requete = $sql->prepare($rq);
$requete->bindParam(':terme',$_GET['terme']);
$res = $requete->execute();
echo "<table>";
echo "<th>Nom</th><th>Explication</th><th>URL</th>";
while($ligne = $requete->fetch(PDO::FETCH_OBJ)) {
    tab_result($ligne);
}
echo "</table>";
retour("index.html");
fin();

?>
