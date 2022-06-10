$(document).ready(function (){
    seleccionarSubmenuLateral();
    llenarEspacioFooter();
})

/*Si se selecciona un submenú en la barra lateral, le pone un borde blanco para saber en que submenú se está posicionado*/
function seleccionarSubmenuLateral(){
    var $menu = $('#menu'),
        $menu_openers = $menu.children('ul').find('.opener');
    var $childrens = $menu_openers.next('ul').children('li').children('a');
    for (let i = 0; i<$childrens.length; i++){
        if(window.location.href == $childrens[i].href){
            $($childrens[i]).parent().parent().prev('span').addClass('active')
            $($childrens[i]).css('color','#0f58a4')
            $($childrens[i]).css('background-color','#FFF')
            $($childrens[i]).css('border-radius','8px')
            $($childrens[i]).css('padding','0.5em 1em')
            $($childrens[i]).css('display','initial')

            break;
        }
    }
}

/*Insertar un div vacío para llenar el espacio que hay antes del footer para que quede en la parte inferior de la sidebar*/
async function llenarEspacioFooter(){
    //Esperar 50ms antes de hacer el cálculo, si no se espera, calcula mal
    await sleep(50)
    let footer = $('#foot');
    let pixeles = $('#sidebar').height()-(footer.offset().top + footer.height());
    pixeles -= 18;
    $(`<div style='height:${pixeles}px'><!-- Espacio rellenado por la función llenarEspacioFooter() --></div>`).insertBefore(footer);
}

function sleep(n) {
    return new Promise(resolve=>setTimeout(resolve,n));
}

