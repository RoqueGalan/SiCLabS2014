$(document).ready(function () {
    $('#FormNoticia').bootstrapValidator({
        fields: {
            /*
             * Titulo
             * Requerido
             * Alfanumerico
             * Rango (2,256)
             */
            Titulo: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 2,
                        max: 256,
                        message: 'Campo longitud Min(2) Max (256) caracteres.'
                    },
                    regexp: {
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ0-9 ]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    }
                }
            },
            /*
             * Select_Espacio:
             * Requerido
             * Numerico
             */
            Select_Espacio: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    }
                }
            }
        }
    });
});

