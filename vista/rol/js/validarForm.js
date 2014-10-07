$(document).ready(function () {
    $('#FormRol').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            Nombre: {
                message: 'El Campo no es valido',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido y no puede estar vacio'
                    },
                    stringLength: {
                        min: 4,
                        max: 32,
                        message: 'Campo debe ser de Min 4 Max 32 caracteres de largo'
                    },
                    regexp: {
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ ]+)$/,
                        message: 'Solo debe contener letras'
                    },
                    // Crear un request Ajax
                    // se envia { Nombre: 'el valor' } para validarlo
                    remote: {
                        message: 'Este nombre no esta disponible',
                        type : 'POST',
                        url: 'http://192.168.0.3/SiCLabS2014/rol/_comprobarNombre/',
                        
                    }
                }
            }
        }
    });
});

