$('.documentoPop').click(function(e) {
    var str = $(this).attr('data-img-url');
    var str = str.split(".");
    var tipo = str.pop();
    
    //tipos que se visualizan
    var visuales = new Array('pdf');
    
    // -1 no existe
    if($.inArray(tipo,visuales) != -1){
        $('#ModalDocumentoPop iframe').attr('src', $(this).attr('data-img-url')); 
        $('#ModalDocumentoPop').modal('show');
    }else{
        window.open($(this).attr('data-img-url'));
    }
   
});



