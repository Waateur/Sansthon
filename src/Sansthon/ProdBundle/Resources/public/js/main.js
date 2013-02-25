$(function(){
	$('.dropdown-toggle').dropdown();
	$('select').chosen();
	$('table').tablesorter();
	$('#general >tbody >tr >td').tooltip();
  $('.table-condensed tbody tr').click(function(){ 
      $(this).toggleClass('hover'); 
    });
});
