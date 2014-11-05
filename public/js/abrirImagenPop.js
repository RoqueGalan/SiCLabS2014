
$('.imagenPop').click(function (e) {
    $('#ModalImagenPop img').attr('src', $(this).attr('data-img-url'));
    $('#ModalImagenPop').modal('show');
});




