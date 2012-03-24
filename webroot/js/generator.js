$(document).ready(function(){


//Filtrowanie podczas wyboru championa:
if($('#new_build-filter').length){  //jeżeli jest okno do filtrowania:
    $('#new_build-filter').focus();
    $('#new_build-filter').keyup(function(){ //po kazdej literze:
        if($(this).attr('value') == ''){
            $('#list-champions a').show();
        }else{
            var word = ($(this).attr('value')).toLowerCase();
            $('#list-champions a').hide().filter('[name*="'+word+'"]').show();
        }
    });
}





});