$(document).ready(function () {
    $('#FormRol').bootstrapValidator({
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
                        min: 4,
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
                        type : 'POST',
                        url: 'http://192.168.0.3/SiCLabS2014/rol/_comprobarNombre/',
                        
                    }
                }
            }
        }
    });
});

