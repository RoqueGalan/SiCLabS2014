$(document).ready(function () {
    $('#FormImagenNoticia').bootstrapValidator({
        fields: {
            /*
             * Titulo
             * Alfanumerico
             * Rango (2,256)
             */
            Titulo: {
                message: 'Campo Invalido.',
                validators: {
                    stringLength: {
                        min: 2,
                        max: 256,
                        message: 'Campo longitud Min(2) Max (64) caracteres.'
                    },
                    regexp: {
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ0-9 ]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    }
                }
            },
            /*
             * Descripcion
             * Letras y Numeros
             */
            Descripcion: {
                message: 'El Campo invalido.',
                validators: {
                    regexp: {
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ0-9 ]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    }
                }
            },
            /*
             * Imagen:
             * imagen
             */
            Imagen: {
                validators: {                    
                    file: {
                        extension: 'jpeg,jpg,png,tiff',
                        type: 'image/jpeg,image/png,image/tiff',
                        message: 'La imagen es incorrecta'
                    }
                }
            }

        }
    });
});

