$(document).ready(function () {
    $('#FormCurso').bootstrapValidator({
        fields: {
            /*
             * Select_Carrera:
             * Requerido
             * Numerico
             */
            Select_Carrera: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    }
                }
            },
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
             * Select_Asignatura:
             * Requerido
             * Numerico
             */
            Select_Asignatura: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    // Envia { Select_Uda, Select_Grupo, Select_Ciclo} al back-end
                    remote: {
                        message: 'Curso Repetido',
                        type: 'POST',
                        url: ROOT + 'curso/_comprobar/',
                        data: function (validator) {
                            return {
                                Select_Asignatura: validator.getFieldElements('Select_Asignatura').val(),
                                Select_Carrera: validator.getFieldElements('Select_Carrera').val(),
                                Select_Grupo: validator.getFieldElements('Select_Grupo').val(),
                                Select_Ciclo: validator.getFieldElements('Select_Ciclo').val(),
                                Select_Espacio: validator.getFieldElements('Select_Espacio').val(),
                                Id: validator.getFieldElements('Id').val()

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
        $('#FormCurso').bootstrapValidator('revalidateField', 'Select_Asignatura');
    });
    $('#Select_Grupo').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormCurso').bootstrapValidator('revalidateField', 'Select_Asignatura');
    });
    $('#Select_Ciclo').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormCurso').bootstrapValidator('revalidateField', 'Select_Asignatura');
    });
    $('#Select_Espacio').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormCurso').bootstrapValidator('revalidateField', 'Select_Asignatura');
    });
});

