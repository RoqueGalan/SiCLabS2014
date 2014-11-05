$(document).ready(function () {
    $('#FormPermiso').bootstrapValidator({
        fields: {
            Nombre: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 2,
                        max: 128,
                        message: 'Campo longitud Min(2) Max(128) caracteres.'
                    },
                    // Crear un request Ajax
                    // se envia { Nombre: 'el valor' } para validarlo
                    remote: {
                        message: 'Registro ya existe.',
                        type: 'POST',
                        url: ROOT + 'permiso/_comprobarNombre/',
                    }
                }
            },
            Descripcion: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 2,
                        max: 512,
                        message: 'Campo longitud Min(2) Max(512) caracteres.'
                    }
                }
            }
        }
    });
});

