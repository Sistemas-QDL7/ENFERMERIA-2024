$(function(){

    // Lista de docente
    $.post( '../../frontend/funciones/patiens.php' ).done( function(respuesta)
    {
        $( '#pati' ).html( respuesta );
    });
    
    
    // Lista de Ciudades
    $( '#pati' ).change( function()
    {
        var el_continente = $(this).val();

    });


    
    
    

})
