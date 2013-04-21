$( 'document' ).ready( function() {
    $( 'li.dropdown a' ).click( function() {
        $( 'li.dropdown a' ).children( "ul" ).each( function( ul ) {
            if( $( ul ).is( ":visible" ) ) { 
                $( ul ).slideUp(); 
            }             
        } );
            
        if( $( this ).parent().children( "ul" ).is( ":hidden" ) ) { 
            $( this ).parent().children( "ul" ).slideDown(); 
        } 
        else { 
            $( this ).parent().children( "ul" ).slideUp(); 
        }
    } );    
} );