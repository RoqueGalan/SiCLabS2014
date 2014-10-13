$(document).ready(function () {
    $('#FormUsuario').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'fa fa-2x fa-check',
            invalid: 'fa fa-2x fa-times',
            validating: 'fa fa-2x fa-refresh fa-spin'
        },
        fields: {
            /*
             * Matricula
             * Requerido
             * Numerico
             * Solo 7 caracteres
             */
            Matricula: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    numeric: {
                        message: 'Campo solo númerico.'
                    },
                    stringLength: {
                        min: 7,
                        max: 7,
                        message: 'Campo longitud 7 caracteres.'
                    },
                    // Crear un request Ajax
                    // se envia { Matricula: 'el valor' } para validarlo
                    remote: {
                        message: 'Registro ya existe.',
                        type: 'POST',
                        url: 'http://192.168.0.3/SiCLabS2014/usuario/_comprobarMatricula/',
                    }
                }
            },
            /*
             * Nombre (s)
             * Requerido
             * Letras
             * Rango (2,64)
             */
            Nombre: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 2,
                        max: 64,
                        message: 'Campo longitud Min(2) Max (64) caracteres.'
                    },
                    regexp: {
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ ]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    }
                }
            },
            /*
             * Apellido (s)
             * Requerido
             * Letras
             * Rango (2,64)
             */
            Apellido: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 2,
                        max: 64,
                        message: 'Campo longitud Min(2) Max (64) caracteres.'
                    },
                    regexp: {
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ ]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    }
                }
            },
            /*
             * Correo
             * Requerido
             * Correo
             * Longitud Max 64
             */
            Correo: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        max: 64,
                        message: 'Campo longitud Max (64) caracteres.'
                    },
                    emailAddress: {
                        message: 'Dirección invalida.'
                    }
                }
            },
            /*
             * Contraseña
             * Requerido
             */
            Contrasena: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        max: 64,
                        message: 'Campo longitud Max (64) caracteres.'
                    }
                }
            },
            /*
             * Select-Rol:
             * Requerido
             * Numerico
             */
            Select_Rol: {
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

