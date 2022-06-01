yii.confirm = function (message, okCallback, cancelCallback){
    SVGFEDropShadowElement({
       title: message,
       type: 'warning',
       showCancelButton: true,
       closeOnConfirm: true,
       allowOutsideClick: true

    }, okCallback);



    
};