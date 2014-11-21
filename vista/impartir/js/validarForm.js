$(document).ready(function () {
    $('#FormImpartir').bootstrapValidator({
        fields: {
            /*
         * Select-Curso:
         * Requerido
         * Numerico
         */
            Select_Curso: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    }
                }
            },
            /*
         * Select-Usuario:
         * Requerido
         * Numerico
         */
            Select_Usuario: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
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

