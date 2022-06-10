$(document).ready(function (){
    agregarModalConfirmacion();
})

//Confirmación cuando es llamado desde Javascript
const ui = {
    confirmDiagog: async (message) => {
        return new Promise((complete, failed)=>{
            //Eliminar elemento <a> ya que no se usa en este contexto
            $('#dataConfirmATag').remove();

            let dataConfirmModal = $('#dataConfirmModal');
            dataConfirmModal.find('#texto-confirmacion').text(message);
            $('#dataConfirmButtonTag').on('click', ()=> {
                $('#dataConfirmModal').modal('hide');
                complete(true);
            });
            $('#dataCancel').on('click', ()=> {
                $('#dataConfirmModal').modal('hide');
                complete(false);
            });
            dataConfirmModal.modal({show:true});
        });
    }
}
//Fin confirmación cuando es llamado desde Javascript

//Confirmación para <button...> ó <a href...> con data-confirm="blablabla"
function agregarModalConfirmacion(){
    //<a> tags
    $('a[data-confirm],button[data-confirm]').click(function(ev) {
        var href = $(this).attr('href');
        var method = $(this).attr('data-method');
        var tag = $(this).prop('tagName');
        tag = tag.toLowerCase();
        let dataConfirmModal = $('#dataConfirmModal');
        dataConfirmModal.find('#texto-confirmacion').text($(this).attr('data-confirm'));

        //En caso de que el disparador sea un botón que hace submit a un formulario y se debe confirmar antes
        if (tag === "button"){
            //Eliminar elemento <a> con estilo de botón ya que no se usa si el original es un elemento <button>
            $('#dataConfirmATag').remove();
            let form = $(this).closest("form");
            $('#dataConfirmButtonTag').on('click', function (e) {
                form.submit();
                $('#dataConfirmModal').modal('hide');
            })
        }

        //En caso de que el disparador sea un elemento <a> que se deba confirmar antes de navegar a href
        if (tag === "a"){
            //Eliminar elemento <button> ya que no se usa si el original es elemento <a>
            $('#dataConfirmButtonTag').remove();
            let dataConfirmATag = $('#dataConfirmATag')
            dataConfirmATag.attr('href', href);
            if (method === "post" ){
                dataConfirmATag.attr('data-method', method);
            }
        }

        dataConfirmModal.modal({show:true});
        return false;
    });

}