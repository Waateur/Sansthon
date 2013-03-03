$(function(){
    //$('.dropdown-toggle').dropdown();
    //$('table').tablesorter();
    //$('#general >tbody >tr >td').tooltip();
    //$('.table-condensed tbody tr').click(function(){ 
    //    $(this).toggleClass('hover'); 
    // });
    $('select').not('[multiple]').chosen({
    allow_single_deselect: true
    });

    $(".dateform").datepicker({
      "language" : "fr",
      "format" : "yyyy-mm-dd"
      });

});
