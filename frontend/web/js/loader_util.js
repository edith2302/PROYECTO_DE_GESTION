
jQuery(document).ready(function (){
    hideLoader();
    eventShowLoaderBeforeLoadingNewPage();
})

function eventShowLoaderBeforeLoadingNewPage(){
    window.addEventListener('beforeunload',(event) =>{
        showLoader();
    });
}

/* timeout es en milisegundos (ms) */
function showLoader(timeout = undefined){
    //console.trace();
    if (timeout===undefined){
        document.getElementById('loader').style.display = "";
    }else if (!isNaN(timeout)){
        setTimeout(function () {
            document.getElementById('loader').style.display = "";
        }, timeout)
    }
}

/* timeout es en milisegundos (ms) */
function hideLoader(timeout = undefined){
    //console.trace();
    if (timeout===undefined){
        document.getElementById('loader').style.display = "none";
    }else if (!isNaN(timeout)){
        setTimeout(function () {
            document.getElementById('loader').style.display = "none";
        }, timeout)
    }
}

/* timeout es en milisegundos (ms) */
function toggleLoader(timeout = undefined){
    //console.log("ToggleLoader")
    let loader = document.getElementById('loader');
    if (timeout===undefined){
        if (loader.style.display === 'none'){
            loader.style.display = "";
        }else{
            loader.style.display = "none";
        }
    }else if (!isNaN(timeout)){
        setTimeout(function () {
            if (loader.style.display === 'none'){
                loader.style.display = "";
            }else{
                loader.style.display = "none";
            }
        }, timeout)
    }
}


/* No usar JQUERY para esta funcionalidad
function showLoader(timeout = undefined){
    //console.trace();
    if (timeout===undefined){
        $('#loader').show();
    }else if (!isNaN(timeout)){
        setTimeout(function () {
            $('#loader').show();
        }, timeout)
    }
}

function hideLoader(timeout = undefined){
    //console.trace();
    if (timeout===undefined){
        $('#loader').hide();
    }else if (!isNaN(timeout)){
        setTimeout(function () {
            $('#loader').hide();
        }, timeout)
    }
}

function toggleLoader(timeout = undefined){
    //console.log("ToggleLoader")
    if (timeout===undefined){
        $('#loader').toggle();
    }else if (!isNaN(timeout)){
        setTimeout(function () {
            $('#loader').toggle();
        }, timeout)
    }
}
*/