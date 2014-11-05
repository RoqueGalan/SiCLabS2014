$(document).ready(function () {
    $('#FormDocumentoEspacio').bootstrapValidator({
        fields: {
            /*
             * Documento:
             * Requerido
             * *Todo tipo de documentos
             */
            Documento: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    file: {
                        extension: 'pdf',
                        type: 'application/pdf',
                        message: 'El Documento es incorrecto'
                    }
                }
            },
            /*
             * Select_TipoDocumento:
             * Requerido
             * Numerico
             * Solo 1 tipo por espacio
             */
            Select_TipoDocumento: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    // Envia { Select_Rol, Select_Permiso'} al back-end
                    remote: {
                        message: 'El tipo de documento ya existe',
                        type: 'POST',
                        url: ROOT + 'documentoEspacio/_comprobarDocumentoEspacio/'+ $('#EspacioId').val()
                    }
                }
            }
        }
    });
});

