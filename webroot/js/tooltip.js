$(document).ready(function(){

    var base_url = '/'+window.location.pathname.split( '/' )[1];

    $('img.ss, img.item, img.champ, img.rune, img.skill').tooltip({
        track: true,
        delay: 0,
        showURL: false,
        top: 10,
        left: 10,
        bodyHandler: function() {
            var nameT = $(this).attr('class');
            nameT = nameT.split(' ');
            return $('<div id="tooltip-'+nameT[0]+'"></div>').load(base_url+'/tooltips',{'type':nameT[0],'id':$(this).attr('tip_id')});
        }
    });/*

    $('img.item').tooltip({
        track: true,
        delay: 0,
        showURL: false,
        top: 10,
        left: 10,
        bodyHandler: function() {
            return $('<div id="tooltip-item"></div>').load(base_url+'/tooltips',{'type':'item','id':$(this).attr('tip_id')});
        }
    });


    $('img.champ').tooltip({
        track: true,
        delay: 0,
        showURL: false,
        top: 10,
        left: 10,
        bodyHandler: function() {
            return $('<div id="tooltip-champ"></div>').load(base_url+'/tooltips',{'type':'champ','id':$(this).attr('tip_id')});
        }
    });
    */
/*
    $('img.ss').tooltip({
        track: true,
        delay: 0,
        showURL: false,
        top: 10,
        left: 10,
        bodyHandler: function() {
        var klasa = $(this).attr('name');
        return $('<div></div>').append($('[name="'+klasa+'"]').html());
        //return jQuery('h3').html(klasa);
        }
    });
*/



});