$(document).ready(function () {
    $('#FormEquipo').bootstrapValidator({
        fields: {
            /*
             * Nombre
             * Requerido
             * Rango (1,64)
             */
            Nombre: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 1,
                        max: 64,
                        message: 'Campo longitud Min(1) Max (64) caracteres.'
                    }
                }
            },
            /*
             * Marca
             * Rango (0,32)
             */
            Marca: {
                message: 'Campo Invalido.',
                validators: {
                    stringLength: {
                        min: 0,
                        max: 32,
                        message: 'Campo longitud Max (32) caracteres.'
                    }
                }
            },
            /*
             * Modelo
             * Rango (0,32)
             */
            Modelo: {
                message: 'Campo Invalido.',
                validators: {
                    stringLength: {
                        min: 0,
                        max: 32,
                        message: 'Campo longitud Max (32) caracteres.'
                    }
                }
            },
            /*
             * NoSerie
             * Rango (0,32)
             */
            NoSerie: {
                message: 'Campo Invalido.',
                validators: {
                    stringLength: {
                        min: 0,
                        max: 32,
                        message: 'Campo longitud Max (32) caracteres.'
                    }
                }
            },
            /*
             * Select-Condicion:
             * Requerido
             * Solo acepta: 'Excelente', 'Bueno' , 'Regular', 'Malo', 'Pesimo'
             */
            Select_Condicion: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    }
                }
            },
            /*
             * CantidadTotal
             * Requerido
             * Rango (0,32)
             */
            CantidadTotal: {
                message: 'Campo Invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    numeric: {
                        message: 'Campo debe ser númerico.'
                    },
                    between: {
                        min: 1,
                        max: 9999,
                        message: 'Campo minimo 1'
                    }
                    //validar al actualizar que no tenga 
                    //equipo en prestamo

                }
            },
            /*
             * CodigoNacion
             * Rango (0,64)
             */
            CodigoNacion: {
                message: 'Campo Invalido.',
                validators: {
                    stringLength: {
                        min: 0,
                        max: 64,
                        message: 'Campo longitud Max (64) caracteres.'
                    }
                }
            },
            /*
             * CodigoUaem
             * Rango (0,32)
             */
            CodigoUaem: {
                message: 'Campo Invalido.',
                validators: {
                    stringLength: {
                        min: 0,
                        max: 32,
                        message: 'Campo longitud Max (32) caracteres.'
                    }
                }
            },
            /*
             * Imagen:
             * imagen
             */
            Imagen: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png,tiff',
                        type: 'image/jpeg,image/png,image/tiff',
                        message: 'La imagen es incorrecta'
                    }
                }
            },
            /*
             * Documento:
             * *Todo tipo de documentos
             */
            Documento: {
                validators: {
                    file: {
                        extension: 'doc,docx,dotx,pdf,potx,ppsx,ppt,pptx,rar,zip,txt,xlam,xls,xlsb,xlsx,xltx',
                        type: 'application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.wordprocessingml.template,application/pdf,application/vnd.openxmlformats-officedocument.presentationml.template,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/x-rar-compressed,application/zip,text/plain,application/vnd.ms-excel.addin.macroEnabled.12,application/vnd.ms-excel,application/vnd.ms-excel.sheet.binary.macroEnabled.12,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.spreadsheetml.template',
                        message: 'La imagen es incorrecta'
                    }
                }
            },
            /*
             * Select-Oculto:
             * Requerido
             * Solo acepta: 'Visible', 'Oculto'
             */
            Select_Oculto: {
                message: 'Campo Invalido.',
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
            }
        }
    });
});

