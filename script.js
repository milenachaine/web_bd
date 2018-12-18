$(document).ready(function(){
  alert( "Formulaire !" );

  var mesOptions = {
    data: ["Python", "Perl", "C++", "CSS", "PHP", "Java", "Javascript"],
    list: {
      sort: {enabled: true},
      match: {enabled: true}
    }
  };

  $("#tags").easyAutocomplete(mesOptions);
  
});
