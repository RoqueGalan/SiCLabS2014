$(document).ready(function () {
    $('#FormEspacio').bootstrapValidator({

        fields: {
            /*
             * Nombre
             * Requerido
             * Letras
             * Rango (1,128)
             */
            Nombre: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 1,
                        max: 128,
                        message: 'Campo longitud Min(2) Max (64) caracteres.'
                    },
                    regexp: {
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ0-9 ]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    }
                }
            },
            Select_TipoEspacio: {
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

