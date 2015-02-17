$(document).ready(function () {
    $('#FormCurso').bootstrapValidator({
        fields: {
            /*
             * Select_Grupo:
             * Requerido
             * Numerico
             */
            Select_Grupo: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    }
                }
            },
            /*
             * Select_Ciclo:
             * Requerido
             * Numerico
             */
            Select_Ciclo: {
                message: 'El Campo invalido.',
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
            },
            /*
             * Select_Uda:
             * Requerido
             * Numerico
             */
            Select_Uda: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    // Envia { Select_Uda, Select_Grupo, Select_Ciclo} al back-end
                    remote: {
                        message: 'UDA ya asignada al grupo y ciclo',
                        type: 'POST',
                        url: ROOT + 'curso/_comprobar/',
                        data: function (validator) {
                            return {
                                Select_Grupo: validator.getFieldElements('Select_Grupo').val(),
                                Select_Ciclo: validator.getFieldElements('Select_Ciclo').val(),
                                Select_Espacio: validator.getFieldElements('Select_Espacio').val()

                            };
                        }
                    }
                }
            }
        }
    });
    // revalidar campos
    $('#Select_Grupo').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormCurso').bootstrapValidator('revalidateField', 'Select_Uda');
    });
    $('#Select_Ciclo').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormCurso').bootstrapValidator('revalidateField', 'Select_Uda');
    });
    $('#Select_Espacio').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormCurso').bootstrapValidator('revalidateField', 'Select_Uda');
    });
});

