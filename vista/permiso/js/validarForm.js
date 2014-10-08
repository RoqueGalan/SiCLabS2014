$(document).ready(function () {
    $('#FormPermiso').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
             valid: 'fa fa-2x fa-check',
            invalid: 'fa fa-2x fa-times',
            validating: 'fa fa-2x fa-refresh fa-spin'
        },
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
                        url: 'http://192.168.0.3/SiCLabS2014/permiso/_comprobarNombre/',
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

