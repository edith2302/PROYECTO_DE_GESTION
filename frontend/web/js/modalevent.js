/*$(function() {

	$(document).on ('click','.fc-event',function(){
        date = $(this).attr('data-date');

	    $.get('index.php?r=event/view',{'id':date},
        function(data){
            $('#modal').modal('show')
	        .find('#modalContent')
	        .html(data);
	    });
    });

   $('#modalButton').click(function(){
      $('#modal').modal('show')
	    .find('#modalContent')
		.load($(this).attr('value'));
    });

});*/

$(function () {
    $('#modalButton').click(function () {
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });

    $(document).on('click', '.fc-day', function () {
        var date = $(this).attr('data-date');
        $.get('index.php?r=event/view', {'id': $model['id']}, function (data) {
            $('#modal').modal('show')
                .find('#modalContent')
                .html(data);
        });
    });
});



