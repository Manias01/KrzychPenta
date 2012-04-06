$(document).ready(function(){

//------Filtrowanie podczas wyboru championa:------
    if($('#new_build-filter').length){  //jeżeli jest okno do filtrowania:
        $('#new_build-filter').focus();
        $('#new_build-filter').keyup(function(){ //po kazdej literze:
            if($(this).attr('value') == ''){
                $('#filter-champions a').show();
            }else{
                var word = ($(this).attr('value')).toLowerCase();
                $('#filter-champions a').hide().filter('[name*="'+word+'"]').show();
            }
        });
    }



//------Wybór SS------
    var spell_1 = '';
    var spell_2 = '';
    var spell_nr = 1;

    if($('#chooseSS').length){
        var ss1 = $('input#BuildSs1').attr('value');
        var ss2 = $('input#BuildSs2').attr('value');
        $('.choose1').html('Summoner Spell 1 - '+ss1);
        $('.choose2').html('Summoner Spell 2 - '+ss2);
        $('.sspell').filter('[id="'+ss1+'"]').addClass('highlight-choose1');
        $('.sspell').filter('[id="'+ss2+'"]').addClass('highlight-choose2');
    }

    $('.sspell').click(function(){
        if(spell_nr == 1 && spell_2.alt != this.id){
            $('.sspell').removeClass('highlight-choose1');
            $(this).addClass('highlight-choose1');
            spell_1 = this;
            $('.choose1').html('Summoner Spell 1 - '+this.id);
            $('#BuildSs1').attr('value', this.id);
            spell_nr = 2;
        }else if(spell_nr == 2 && spell_1.alt != this.id){
            $('.sspell').removeClass('highlight-choose2');
            $(this).addClass('highlight-choose2');
            spell_2 = this;
            $('.choose2').html('Summoner Spell 2 - '+this.id);
            $('#BuildSs2').attr('value', this.id);
            spell_nr = 1;
      }
    });




//------Wybór runy------
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



//------Itemy - drag & drop------
    $("#items-destination").sortable().disableSelection();
    $("#items-ready img").draggable({
        appendTo: "body",
        helper: "clone",
        start: function(){
            $(".item-box-img").addClass('items-highlight');
        },
        stop: function(){
             $(".item-box-img").removeClass('items-highlight');
        }
    });

    $(".item-box").droppable({
          tolerance: 'touch',
          drop: function(event,ui){
              $(this).find('p').html($(ui.draggable).parent('a').attr('name'));
              $(this).find('img').attr('src',$(ui.draggable).attr('src')).attr('tip_id',$(ui.draggable).attr('tip_id')).fadeIn('normal');
          }
    });

    //Kasowanie po kliku na "x"
    $('.item-box-img a.item-delete').click(function(){
        $(this).parent('div').find('img').attr('src','').attr('tip_id','').attr('alt','').fadeOut('normal'); //obrazek zniknij
        $(this).parent('div').parent('div').find('p').html('');              //usun podpis
        return false;
    });


    //Itemy-input-filtrowanie
    $('#items-search').focus();
    $('#items-search').keyup(function(){ //po kazdej literze:
        if($(this).attr('value') == ''){
            $('#items-all a').show();
        }else{
            var word = ($(this).attr('value')).toLowerCase();
            $('#items-all a').hide().filter('[name*="'+word+'"]').show();
        }
    });

    //Zapisanie do form-a wybranych i ustawionych itemow
    $('.submit input').click(function(){
        for(a=1;a<=6;a++){
            $('.item-box').eq((a-1)).attr('tip_id',a);
            $('input#Build'+a).attr('value', $('.item-box-img').eq((a-1)).find('img').attr('tip_id'));
        }
        return true;
    });



//-----Description-----
    if($('form#BuildDescriptionForm').length){
        tinyMCE.init({
            width : "600",
            mode : "textareas",
            theme : "advanced",
            skin : "o2k7",
            skin_variant : "black",
            plugins : "emotions,spellchecker,advhr,insertdatetime,preview,wordcount",

            // Theme options - button# indicated the row# only
            theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
            theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,
            relative_urls : true,
            force_br_newlines : true,
            force_p_newlines : false,
            forced_root_block : ''
        });
    }
    



});