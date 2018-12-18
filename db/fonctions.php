<?php
function affichage($classe, $texte) {
  echo "<p class =\"".$classe."\">".$texte."</p>";
}
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
function fin() {
  echo "</body>";
  echo "</html>";
}

function liste_puces($values) {
  echo "<ul>";
  foreach ($values as $value){
    echo "<li>".$value."</li>";
  }
  echo "</ul>";
}

function tab_xhtml($values, $class) {
  echo "<table class=".$class.">";
  foreach ($values as $value)
  {
     echo "<tr><td class=\"".$class."\">".$value."</td></tr>";
  }
  echo "</table>";
}
?>
