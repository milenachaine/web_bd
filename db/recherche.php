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
$type_bool = $_GET['type'];
$nb_pltfrms = $_GET['pltfrm'];
$lg = $_GET['lg'];
$cats = $_GET['cats'];

if (count($nb_pltfrms) == 1) {
  $rq = "SELECT Ressources.NOM, Ressources.EXPL, Ressources.URL FROM Ressources, ResJoinPltfrm, Plateformes, ResJoinLg, Langages, ResJoinCat, Categories WHERE (Ressources.ID = ResJoinPltfrm.RES AND Plateformes.ID = ResJoinPltfrm.PLTFRM AND Plateformes.ID = :pltfrm) AND (Ressources.ID = ResJoinLg.RES AND Langages.ID = ResJoinLg.LG AND Langages.NOM = :lg) AND (Ressources.ID = ResJoinCat.RES AND Categories.ID = ResJoinCat.CAT AND Categories.ID = :cats);";
  $requete2 = $sql->prepare($rq);
  $requete2->bindParam(':pltfrm',$nb_pltfrms[0]);
  $requete2->bindParam(':lg',$lg);
  $requete2->bindParam(':cats',$cats);
  $res = $requete2->execute();
  while($ligne = $requete2->fetch(PDO::FETCH_OBJ)) {
    liste_puces($ligne);
  }
}
else {
  if ($type_bool == "and") {
    $rq = "SELECT DISTINCT Ressources.NOM, Ressources.EXPL, Ressources.URL FROM Ressources, ResJoinPltfrm, Plateformes, ResJoinLg, Langages, ResJoinCat, Categories WHERE (ResJoinPltfrm.PLTFRM = :pltfrm1 AND Ressources.ID = ResJoinPltfrm.RES AND Ressources.ID IN(SELECT ResJoinPltfrm.RES FROM ResJoinPltfrm WHERE ResJoinPltfrm.PLTFRM = :pltfrm2)) AND (Ressources.ID = ResJoinLg.RES AND Langages.ID = ResJoinLg.LG AND Langages.NOM = :lg) AND (Ressources.ID = ResJoinCat.RES AND Categories.ID = ResJoinCat.CAT AND Categories.ID = :cats);";
    $requete2 = $sql->prepare($rq);
    $requete2->bindParam(':pltfrm1',$nb_pltfrms[0]);
    $requete2->bindParam(':pltfrm2',$nb_pltfrms[1]);
    $requete2->bindParam(':lg',$lg);
    $requete2->bindParam(':cats',$cats);
    $res = $requete2->execute();
    while($ligne = $requete2->fetch(PDO::FETCH_OBJ)) {
      liste_puces($ligne);
    }
  }
  elseif ($type_bool == "or") {
    $rq = "SELECT Ressources.NOM, Ressources.EXPL, Ressources.URL FROM Ressources, ResJoinPltfrm, Plateformes, ResJoinLg, Langages, ResJoinCat, Categories WHERE (Ressources.ID = ResJoinLg.RES AND Langages.ID = ResJoinLg.LG AND Langages.NOM = :lg) AND (Ressources.ID = ResJoinCat.RES AND Categories.ID = ResJoinCat.CAT AND Categories.ID = :cats) AND ResJoinPltfrm.PLTFRM = :pltfrm1 AND Ressources.ID = ResJoinPltfrm.RES UNION SELECT Ressources.NOM, Ressources.EXPL, Ressources.URL FROM Ressources, ResJoinPltfrm, Plateformes, ResJoinLg, Langages, ResJoinCat, Categories WHERE (Ressources.ID = ResJoinLg.RES AND Langages.ID = ResJoinLg.LG AND Langages.NOM = :lg) AND (Ressources.ID = ResJoinCat.RES AND Categories.ID = ResJoinCat.CAT AND Categories.ID = :cats) AND ResJoinPltfrm.PLTFRM = :pltfrm2 AND Ressources.ID = ResJoinPltfrm.RES;";
    $requete2 = $sql->prepare($rq);
    $requete2->bindParam(':pltfrm1',$nb_pltfrms[0]);
    $requete2->bindParam(':pltfrm2',$nb_pltfrms[1]);
    $requete2->bindParam(':lg',$lg);
    $requete2->bindParam(':cats',$cats);
    $res = $requete2->execute();
    while($ligne = $requete2->fetch(PDO::FETCH_OBJ)) {
      liste_puces($ligne);
    }
  }
}

?>
