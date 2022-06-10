
function showSnackbar(text, type) {
    console.log("Showing snackbar..."+ text);
    var snackbar = $('#snackbar');
    switch (type){
        case "error":
            snackbar.css('background-color','red');
            break;
        case "success":
            snackbar.css('background-color','green');
            break;
        case "info":
            snackbar.css('background-color','#1ea4f7');
            break;
        default:
            snackbar.css('background-color','#1ea4f7');
            break;
    }
    //Establece un tiempo de espera luego de que el documento ha sido cargado para lanzar el snackbar
    let timeout = 100;
    //Se verifica cada 10ms si el documento fue cargado completamente
    //si no ha sido cargado, retorna nada, en caso de que ha sido cargado, espera el tiempo
    //de la variable timeout y lanza el snackbar, por alguna razón, el snackbar se muestra mal
    //si es lanzado sin tiempo de espera

    /*Tiempo en ms , debe coincidir con la suma de los parametros de animation: fadein y fadeout en el css.
    Por ejemplo animation: fadein 3s, fadeout 3s 5s, significa que tardará 3 segundos en la transición de entrada (fadein) y 5 segundos en la trancisión de salida (fadeout) y de esos 5 segundos, 3 serán los de desvanecimiento y 2 los que estará fijo en pantalla, por lo que la cantidad de tiempo total en pantalla son 3s (entrada) + 5s (3s de desvanecimiento y 2s fijo en pantalla), = 8s = 8000ms
    */
    let tiempo_snackbar_activo = 5000;
    var tid = setInterval( function () {
        if ( document.readyState !== 'complete' ) return;
        clearInterval( tid );
        setTimeout(
            function(){
                snackbar.text(text);
                snackbar.addClass('show');
            }, timeout
        );
    }, 10 );

    //espera 3000ms + el tiempo de la variable timeout para ocultar el snackbar
    setTimeout(
        function(){
            snackbar.removeClass('show');
        }, tiempo_snackbar_activo + timeout
    );
}