$(document).ready(function () {
    $('#FormCiclo').bootstrapValidator({
        fields: {
            /*
             * Nombre (s)
             * Requerido
             * Letras
             * Rango (2,64)
             */
            Nombre: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 6,
                        max: 6,
                        message: 'Campo longitud 6 caracteres.'
                    },
                    regexp: {
                        regexp: /^\d{4}\-[AB]$/,
                        message: 'El ciclo es invalido.'
                    },
                    // Crear un request Ajax
                    // se envia { Nombre: 'el valor' } para validarlo
                    remote: {
                        message: 'Registro ya existe.',
                        type: 'POST',
                        url: ROOT + 'ciclo/_comprobarNombre/'
                    }
                }
            }
        }
    });
});



