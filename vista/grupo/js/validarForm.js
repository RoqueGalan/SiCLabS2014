$(document).ready(function () {
    $('#FormGrupo').bootstrapValidator({
        fields: {
            /*
             * Nombre (s)
             * Requerido
             * Letras
             * Longitud 2,8
             */
            Nombre: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 2,
                        max: 8,
                        message: 'Campo longitud Min(2) Max (8) caracteres.'
                    },
                    // Crear un request Ajax
                    // se envia { Nombre: 'el valor' } para validarlo
                    remote: {
                        message: 'Registro ya existe.',
                        type: 'POST',
                        url: ROOT + 'grupo/_comprobarNombre/'
                    }
                }
            }
        }
    });
});


