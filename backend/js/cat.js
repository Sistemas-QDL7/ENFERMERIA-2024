$(function(){

    // Lista de docente
    $.post( '../../frontend/funciones/cat.php' ).done( function(respuesta)
    {
        $( '#cat' ).html( respuesta );
    });
    
    
    // Lista de Ciudades
    $( '#cat' ).change( function()
    {
        var el_continente = $(this).val();

    });


    
    
    

})
