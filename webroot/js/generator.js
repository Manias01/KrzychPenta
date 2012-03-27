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

//Wybór SS
var spell_1 = '';
var spell_2 = '';
var spell_nr = 1;

$('.sspell').click(function(){
    if(spell_nr == 1 && spell_2.alt != this.title){
        $('.sspell').removeClass('highlight-choose1');
        $(this).addClass('highlight-choose1');
        spell_1 = this;
        $('label[for="BuildSs1Opis"]').html('Summoner Spell 1 - '+this.title);
        $('#BuildSs1').attr('value', this.title);
        spell_nr = 2;
    }else if(spell_nr == 2 && spell_1.alt != this.title){
        $('.sspell').removeClass('highlight-choose2');
        $(this).addClass('highlight-choose2');
        spell_2 = this;
        $('label[for="BuildSs2Opis"]').html('Summoner Spell 2 - '+this.title);
        $('#BuildSs2').attr('value', this.title);
        spell_nr = 1;
  }
});





});