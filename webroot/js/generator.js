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

    if($('#chooseSS').length){
        var ss1 = $('input#BuildSs1').attr('value');
        var ss2 = $('input#BuildSs2').attr('value');
        $('.choose1').html('Summoner Spell 1 - '+ss1);
        $('.choose2').html('Summoner Spell 2 - '+ss2);
        $('.sspell').filter('[title="'+ss1+'"]').addClass('highlight-choose1');
        $('.sspell').filter('[title="'+ss2+'"]').addClass('highlight-choose2');
    }

    $('.sspell').click(function(){
        if(spell_nr == 1 && spell_2.alt != this.title){
            $('.sspell').removeClass('highlight-choose1');
            $(this).addClass('highlight-choose1');
            spell_1 = this;
            //$('label[for="BuildSs1Opis"]').html('Summoner Spell 1 - '+this.title);
            $('.choose1').html('Summoner Spell 1 - '+this.title);
            $('#BuildSs1').attr('value', this.title);
            spell_nr = 2;
        }else if(spell_nr == 2 && spell_1.alt != this.title){
            $('.sspell').removeClass('highlight-choose2');
            $(this).addClass('highlight-choose2');
            spell_2 = this;
            //$('label[for="BuildSs2Opis"]').html('Summoner Spell 2 - '+this.title);
            $('.choose2').html('Summoner Spell 2 - '+this.title);
            $('#BuildSs2').attr('value', this.title);
            spell_nr = 1;
      }
    });




//Wybór runy
    //--Start strony--
    $('.rune-type').hide();
    $('#rune-1').show();
    $('#button-mark').addClass('runes-button-selected');

    //--Klik na menu z typami run (runes-buttons)--
    $('.runes-button>li').click(function(){
      $('.rune-type').hide();
      $('.runes-button>li').removeClass('runes-button-selected');
      if(this.id=='button-mark') $('#rune-1').show();
      if(this.id=='button-seal') $('#rune-2').show();
      if(this.id=='button-glyph') $('#rune-3').show();
      if(this.id=='button-quint') $('#rune-4').show();
      $(this).addClass('runes-button-selected');
    });

    //--Wybór runy--
    $('.rune').click(function(){
      if($(this).parent('div').attr('id')=='rune-1'){
        $('#Build1').attr('value', $(this).attr('title'));
        $('.rune').removeClass('highlight-rune');
      }
      if($(this).parent('div').attr('id')=='rune-2'){
        $('#Build2').attr('value', $(this).attr('title'));
        $('.rune').removeClass('highlight-rune');
      }
      if($(this).parent('div').attr('id')=='rune-3'){
        $('#Build3').attr('value', $(this).attr('title'));
        $('.rune').removeClass('highlight-rune');
      }
      if($(this).parent('div').attr('id')=='rune-4'){
        $('#Build4').attr('value', $(this).attr('title'));
        $('.rune').removeClass('highlight-rune');
      }
      $(this).addClass('highlight-rune');
    });





});