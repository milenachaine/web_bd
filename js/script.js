$(document).ready(function(){
  alert( "Formulaire !" );

  //autocomplétion
  var langages = {
    data: ["Python", "Perl", "C++", "CSS", "PHP", "Java", "Javascript", "SQL", "Ruby"],
    placeholder: "Langage de programmation",
    list: {
      sort: {enabled: true},
      match: {enabled: true}
    }
  };
  $("#tags").easyAutocomplete(langages);

});
