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

//récupération de tous les paramètres
$type_bool = $_GET['type']; // AND ou OR : est-ce qu'on cherche une ressource disponible sur toutes les plateformes ou au moins une
$nb_pltfrms = $_GET['pltfrm']; //si l'utilisateur a choisi plusieurs plateformes $nb_pltfrms sera une lsite
$lg = $_GET['lg'];
$cats = $_GET['cats'];

//on teste le nombre de plateformes : si une seule est sélectionnée $type_bool n'est pas pertinent => on regroupe les cas
if (count($nb_pltfrms) == 1) {
  $rq = "SELECT Ressources.NOM, Ressources.EXPL, Ressources.URL FROM Ressources, ResJoinPltfrm, Plateformes, ResJoinLg, Langages, ResJoinCat, Categories WHERE (Ressources.ID = ResJoinPltfrm.RES AND Plateformes.ID = ResJoinPltfrm.PLTFRM AND Plateformes.ID = :pltfrm) AND (Ressources.ID = ResJoinLg.RES AND Langages.ID = ResJoinLg.LG AND Langages.NOM = :lg) AND (Ressources.ID = ResJoinCat.RES AND Categories.ID = ResJoinCat.CAT AND Categories.ID = :cats);";
  // la requête rassemble tous les paramètres et fait une triple sélection
  $requete2 = $sql->prepare($rq);
  //association paramètres
  $requete2->bindParam(':pltfrm',$nb_pltfrms[0]);
  $requete2->bindParam(':lg',$lg);
  $requete2->bindParam(':cats',$cats);
  $res = $requete2->execute();
  echo "<table>";
  echo "<th>Nom</th><th>Explication</th><th>URL</th>";
  while($ligne = $requete2->fetch(PDO::FETCH_OBJ)) {
      tab_result($ligne);
  }
  echo "</table>";
}
else {
  if ($type_bool == "and") {
    // si on veut que la ressource soit disponible sur toutes les plateformes on fait une intersection (SELECT dans SELECT)
    $rq = "SELECT DISTINCT Ressources.NOM, Ressources.EXPL, Ressources.URL FROM Ressources, ResJoinPltfrm, Plateformes, ResJoinLg, Langages, ResJoinCat, Categories WHERE (ResJoinPltfrm.PLTFRM = :pltfrm1 AND Ressources.ID = ResJoinPltfrm.RES AND Ressources.ID IN(SELECT ResJoinPltfrm.RES FROM ResJoinPltfrm WHERE ResJoinPltfrm.PLTFRM = :pltfrm2)) AND (Ressources.ID = ResJoinLg.RES AND Langages.ID = ResJoinLg.LG AND Langages.NOM = :lg) AND (Ressources.ID = ResJoinCat.RES AND Categories.ID = ResJoinCat.CAT AND Categories.ID = :cats);";
    $requete2 = $sql->prepare($rq);
    $requete2->bindParam(':pltfrm1',$nb_pltfrms[0]);
    $requete2->bindParam(':pltfrm2',$nb_pltfrms[1]);
    $requete2->bindParam(':lg',$lg);
    $requete2->bindParam(':cats',$cats);
    $res = $requete2->execute();
    echo "<table>";
    echo "<th>Nom</th><th>Explication</th><th>URL</th>";
    while($ligne = $requete2->fetch(PDO::FETCH_OBJ)) {
        tab_result($ligne);
    }
    echo "</table>";
  }
  elseif ($type_bool == "or") {
    //si on veut qu'elle soit disponible sur au moins une plateforme on fait une union des resources disponibles sur chaque plateforme
    $rq = "SELECT Ressources.NOM, Ressources.EXPL, Ressources.URL FROM Ressources, ResJoinPltfrm, Plateformes, ResJoinLg, Langages, ResJoinCat, Categories WHERE (Ressources.ID = ResJoinLg.RES AND Langages.ID = ResJoinLg.LG AND Langages.NOM = :lg) AND (Ressources.ID = ResJoinCat.RES AND Categories.ID = ResJoinCat.CAT AND Categories.ID = :cats) AND ResJoinPltfrm.PLTFRM = :pltfrm1 AND Ressources.ID = ResJoinPltfrm.RES UNION SELECT Ressources.NOM, Ressources.EXPL, Ressources.URL FROM Ressources, ResJoinPltfrm, Plateformes, ResJoinLg, Langages, ResJoinCat, Categories WHERE (Ressources.ID = ResJoinLg.RES AND Langages.ID = ResJoinLg.LG AND Langages.NOM = :lg) AND (Ressources.ID = ResJoinCat.RES AND Categories.ID = ResJoinCat.CAT AND Categories.ID = :cats) AND ResJoinPltfrm.PLTFRM = :pltfrm2 AND Ressources.ID = ResJoinPltfrm.RES;";
    $requete2 = $sql->prepare($rq);
    $requete2->bindParam(':pltfrm1',$nb_pltfrms[0]);
    $requete2->bindParam(':pltfrm2',$nb_pltfrms[1]);
    $requete2->bindParam(':lg',$lg);
    $requete2->bindParam(':cats',$cats);
    $res = $requete2->execute();
    echo "<table>";
    echo "<th>Nom</th><th>Explication</th><th>URL</th>";
    while($ligne = $requete2->fetch(PDO::FETCH_OBJ)) {
        tab_result($ligne);
    }
    echo "</table>";
  }
}
retour("recherche.html");
fin();
?>
