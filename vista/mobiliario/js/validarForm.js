$(document).ready(function () {
    $('#FormMobiliario').bootstrapValidator({
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

