jQuery( document ).ready( function( $ ) {

    var test;
    function slideCatBlock( isSlideshow, idSlideshow, duration, index ) {
        // Nombre d'éléments de la liste
        var nbElement = $( "#catblock_" + idSlideshow + " .catblock-list li" ).length;
        test = setTimeout( function() {
            if ( index < nbElement )
                index++;
            else
                index = 1;

            /* For slide effect
            jQuery(".catblock-list").animate({
                marginLeft : - (reference.width() * (index-1))
            });*/
            $( "#catblock_" + idSlideshow + " .catblock-list li" ).removeClass( 'active' );
            $( "#catblock_" + idSlideshow + " .catblock-list li.item-" + index ).addClass( 'active' );
            $( "#catblock_" + idSlideshow ).parent().find( ".catblock-nav li" ).removeClass( 'active' );
            $( "#catblock-item-" + idSlideshow + "-" + index ).addClass( 'active' );
            slideCatBlock( isSlideshow, idSlideshow, duration, index ); // on n'oublie pas de relancer la fonction à la fin

        }, duration ); // on définit l'intervalle
    }


    $( ".catblock-wrapper" ).each( function() {
        var idSlideshow = $( this ).attr( 'id' ).substr( 9 );
        var isSlideshow = $( this ).data( 'slideshow' );

        if ( isSlideshow != undefined && $( this ).find( 'ul li' ).length > 1 ) {
            var duration = $( this ).data( 'duration' );
            /* For slide effect
            // Element de référence pour la zone de visualisation (ici le premier item)
            var reference = $( this ).find( ".catblock-list li:first-child" );
            */
            // Actions de navigation
            $( this ).parent().find( ".catblock-nav li" ).on( 'click', function() {
                clearTimeout( test );
                var slide = parseInt( $( this ).data( 'slide' ) );
                /* Pour glissé
                $(".catblock-list").animate({
                    marginLeft : - (reference.width() * (slide-1))
                });*/
                $( "#catblock_" + idSlideshow + " .catblock-list li" ).removeClass( 'active' );
                $( "#catblock_" + idSlideshow + " .catblock-list li.item-" + slide ).addClass( 'active' );
                $( "#catblock_" + idSlideshow).parent().find(".catblock-nav li" ).removeClass( 'active' );
                $( "#catblock-item-" + idSlideshow + "-" + slide ).addClass( 'active' );
                slideCatBlock( isSlideshow, idSlideshow, duration, slide );
            } );
            // Lancement slideshow
            var currentIndex = 1;
            slideCatBlock( isSlideshow, idSlideshow, duration, currentIndex );
        } else {
            $( "#cat_block_" + idSlideshow).parent().find(".catblock-nav" ).hide();
        }
    } );
    
    $( '.catblock-goto' ).on( 'click', function(){
        window.location.href = $( this ).data( 'url' );             
    });


} );
