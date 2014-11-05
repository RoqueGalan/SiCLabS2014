$(document).ready(function () {
    $('#FormSoftware').bootstrapValidator({
        fields: {
            /*
             * Nombre
             * Requerido
             * Rango (1,64)
             */
            Nombre: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 1,
                        max: 64,
                        message: 'Campo longitud Min(1) Max (64) caracteres.'
                    }
                }
            },
            /*
             * Select-Oculto:
             * Requerido
             * Solo acepta: 'Visible', 'Oculto'
             */
            Select_Oculto: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
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

