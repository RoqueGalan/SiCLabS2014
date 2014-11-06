$(document).ready(function () {
    $('#FormUda').bootstrapValidator({
        fields: {
            Select_Carrera: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    }
                }
            },
            /*
             * Nombre
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
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ0-9 ]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    },
                    // Envia { Nombre, Select_Carrera'} al back-end
                    remote: {
                        message: 'El Nombre ya esta asignado a la Carrera',
                        type: 'POST',
                        //url: ROOT + 'uda/_comprobar/' + $('#Select_Carrera').val()
                        url: 'http://localhost/SiCLabS2014/uda/_comprobar/',
                        data: function (validator) {
                            return {
                                Select_Carrera: validator.getFieldElements('Select_Carrera').val()
                            };
                        }
                    }
                }
            }
        }
    });
    // revalidar campos
    $('#Select_Carrera').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormUda').bootstrapValidator('revalidateField', 'Nombre');
    });
});

