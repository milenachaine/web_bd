<?php
//permet d'associer une classe à un paragraphe
function affichage($classe, $texte) {
  echo "<p class =\"".$classe."\">".$texte."</p>";
}

//affiche un en-tête xhtml généré en PHP
function entete($title,$charset,$stylesheet,$author,$description,$keywords,$replyto) {
  echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">";
  echo "<html xmlns =\"http://www.w3.org/1999/xhtml\">";
  echo "<head>";
  echo "<title>".$title."</title>";
  echo "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=".$charset."\"/>";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$stylesheet."\"/>";
  echo "<meta name=\"author\" content=\"".$author."\"/>";
  echo "<meta name=\"description\" content=\"".$description."\"/>";
  echo "<meta name=\"keywords\" content=\"".$keywords."\"/>";
  echo "<meta name=\"reply-to\" content=\"".$replyto."\"/>";
  echo "</head>";
  echo "<body>";
}

//génère le logo, le bandeau et le menu de chaque page
function debut($titre){
  echo "<div id=\"logo\">";
  echo "<a href=\"https://experiments.withgoogle.com/autodraw\"><img src=\"../web/logo.png\" alt=\"Logo\" /></a></div>";
  echo "<div id=\"bandeau\"><h1><b>Bases de données pour le Web : projet final</b></h1>  </div><h2>".$titre."</h2>";
  echo "<div id=\"menu\"><a href=\"../web/index.html\">Accueil</a><a href=\"../web/recherche.html\">Recherche</a><a href=\"../web/ajout.html\">Ajout</a><a href=\"http://github.com/milenachaine/web_bd\">GitHub</a></div>";
}

//génère un pied de page et une fin de document xhtml
function fin() {
  echo "<div id=\"footer_div\"><p id=\"footer\">";
  echo "<a href=\"http://validator.w3.org/check?uri=referer\"><img class=\"valid\" src=\"http://www.w3.org/Icons/valid-xhtml10\" alt=\"Valid XHTML 1.0 Strict\" height=\"31\" width=\"88\" /></a>";
  echo "<a href=\"http://jigsaw.w3.org/css-validator/check/referer\"> <img class=\"valid\" style=\"border:0;width:88px;height:31px\" src=\"http://jigsaw.w3.org/css-validator/images/vcss\" alt=\"CSS Valide !\" />";
  echo "</a>Milena Chaîne - Bases de données sur le web (2018-2019, Inalco)</p></div>";
  echo "</body>";
  echo "</html>";
}

//génère une liste à puces
function liste_puces($values) {
  echo "<ul>";
  foreach ($values as $value){
    echo "<li>".$value."</li>";
  }
  echo "</ul>";
}

//génère un tableau (v.1)
function tab_xhtml($values, $class) {
  echo "<table class=".$class.">";
  foreach ($values as $value)
  {
    echo "<tr><td class=\"".$class."\">".$value."</td></tr>";
  }
  echo "</table>";
}

//génère un tableau de résultats
function tab_result($values) {
  echo "<tr>";
  foreach ($values as $value)
  {
    echo "<td>".$value."</td>";
  }
  echo "</tr>";
}

//génère une page de retour au formulaire (en cas de problème notamment)
function retour($page) {
  echo "<p><a href=\"../web/".$page."\">Retour à la page précédente</a></p>";
}
?>
