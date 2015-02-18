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
             */
            Select_Asignatura: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    // Envia { Select_Asignatura, Select_Carrera'} al back-end
                    remote: {
                        message: 'Asignatura ya asignada a la Carrera',
                        type: 'POST',
                        url: ROOT + 'uda/_comprobarAsignaturaCarrera/',
                        data: function (validator) {
                            return {
                                Select_Carrera: validator.getFieldElements('Select_Carrera').val(),
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
        $('#FormUda').bootstrapValidator('revalidateField', 'Select_Asignatura');
    });
    
    $('#Select_Asignatura').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormUda').bootstrapValidator('revalidateField', 'Select_Carrera');
    });
});

