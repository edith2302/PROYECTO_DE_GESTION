/*(function() {})();*/

$(document).ready(function(){
    fix_filters();
    fix_forms();
})

function fix_filters(){
    let scripts = $("script");
    for(let i = 0; i< scripts.length ; i++){
        let content = $(scripts[i]).text()
        let _url_to_splitted = url_to.split('/').join('\\/').split("index")[0];
        if (content.includes("yiiGridView") && content.includes(_url_to_splitted)) {
            $(scripts[i]).remove();
            let new_script = $(scripts[i]).text();
            eval(new_script.split(_url_to_splitted).join(url_current.split("index")[0]));
        }
    }
}

function fix_forms(){
    let forms = document.getElementsByTagName("form");
    for (let i = 0; i < forms.length; i++) {
        let action = forms[i].getAttribute("action")

        /* Si url_to es igual al action del formulario, quiere decir que no se estableció manualmente un action
        * y este fue generado automáticamente, además si url_to es distinto a url_current, quiere decir que para
        * la generación se utilizó el método Url::to el cual, en caso de que la URL estén enmascarada, no entrega
        * un valor correcto, y el que entrega un valor correcto es Url::current, el cual asignamos como nuevo action
        * del formulario, en caso de que el action se haya establecido manualmente en el formulario, url_to será
        * distinto del action y este reemplazo no ocurrirá
        */
        if (url_to == action && url_to != url_current) {
            forms[i].setAttribute("action",url_current);
        }
    }
}