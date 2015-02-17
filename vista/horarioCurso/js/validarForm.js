$(document).ready(function () {
    $('#FormHorarioCurso').bootstrapValidator({
        fields: {
            /*
             * Dia:
             * Requerido
             * Solo acepta: 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'
             */
            Select_Dia: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    }
                }
            },
            /*
             * Fin:
             * Requerido
             * Tiempo
             * Rango: 7:00 a 21:00
             */
            Fin: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    remote: {
                        message: 'Error de hora',
                        type: 'POST',
                        url: ROOT + 'horarioCurso/_comprobar/2',
                        data: function (validator) {
                            return {
                                Inicio: validator.getFieldElements('Inicio').val()
                            };
                        }
                    }
                }
            },
            /*
             * Select_Curso:
             * Requerido
             * Numerico
             */
            Select_Curso: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    }
                }
            },
            /*
             * Inicio:
             * Requerido
             * Tiempo
             * Rango: 7:00 a 21:00
             * Menor a Fin
             * Val No repetido
             */
            Inicio: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    remote: {
                        message: 'Error de hora',
                        type: 'POST',
                        url: ROOT + 'horarioCurso/_comprobar/1',
                        data: function (validator) {
                            return {
                                Select_Curso: validator.getFieldElements('Select_Curso').val(),
                                Fin: validator.getFieldElements('Fin').val(),
                                Select_Dia: validator.getFieldElements('Select_Dia').val()

                            };
                        }
                    }
                }
            }
        }
    });
    // revalidar campos
    $('#Inicio').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormHorarioCurso').bootstrapValidator('revalidateField', 'Fin');
    });
    $('#Fin').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormHorarioCurso').bootstrapValidator('revalidateField', 'Inicio');
    });
    $('#Select_Dia').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormHorarioCurso').bootstrapValidator('revalidateField', 'Inicio');
        $('#FormHorarioCurso').bootstrapValidator('revalidateField', 'Fin');
    });
});

