$(function(){

    // Lista de docente
    $.post( '../../frontend/funciones/doctor.php' ).done( function(respuesta)
    {
        $( '#doc' ).html( respuesta );
    });
    
    
    // Lista de Ciudades
    $( '#doc' ).change( function()
    {
       var el_continente = $(this).val();
        // Lista de Paises
        $.post( '../../frontend/funciones/speciality.php', { continente: el_continente} ).done( function( respuesta )
        {
            $( '#spe' ).html( respuesta );
        });

    });


    
    
    

})
