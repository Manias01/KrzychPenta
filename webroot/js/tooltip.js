$(document).ready(function(){

    //var base_url = '/'+window.location.pathname.split( '/' );
    var base_url = $('#base').attr('base_url');
    
    $('img.ss, img.item, img.champ, img.rune, img.skill').tooltip({
        track: true,
        delay: 1,
        showURL: false,
        top: 10,
        left: 10,
        bodyHandler: function() {
            var nameT = $(this).attr('class');
            nameT = nameT.split(' ');
            return $('<div id="tooltip-'+nameT[0]+'"><img src="'+base_url+'/img/nivo-slider/loading.gif" alt="" /></div>').load(base_url+'/tooltips',{'type':nameT[0],'id':$(this).attr('tip_id')});
        }
    });


});