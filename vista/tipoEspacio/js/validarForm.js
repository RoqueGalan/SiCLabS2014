$(document).ready(function() {
    $('#FormTipoEspacio').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        fields: {
            /*
             * Nombre (s)
             * Requerido
             * Letras
             * Rango (2,32)
             */
            Nombre: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 2,
                        max: 32,
                        message: 'Campo longitud Min(4) Max (32) caracteres.'
                    },
                    regexp: {
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ ]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    },
                    // Crear un request Ajax
                    // se envia { Nombre: 'el valor' } para validarlo
                    remote: {
                        message: 'Registro ya existe.',
                        type: 'POST',
                        url: ROOT + 'tipoEspacio/_comprobarNombre/',
                    }
                }
            }
        }
    });
});

