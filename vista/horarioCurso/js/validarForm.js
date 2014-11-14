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
             * Inicio:
             * Requerido
             * Tiempo
             * Rango: 7:00 a 21:00
             * Menor a Fin
             */
            Inicio: {
                message: 'El Campo invalido.',
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
            }
        }
    });
});

