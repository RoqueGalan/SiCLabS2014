$(document).ready(function () {
    $('#FormPermisoRol')
            .bootstrapValidator({
                feedbackIcons: {
                    valid: 'fa fa-2x fa-check',
                    invalid: 'fa fa-2x fa-times',
                    validating: 'fa fa-2x fa-refresh fa-spin'
                },
                fields: {
                    Select_Rol: {
                        message: 'El Campo invalido.',
                        validators: {
                            notEmpty: {
                                message: 'Campo requerido.'
                            },
                            // Envia { Select_Rol, Select_Permiso'} al back-end
                            remote: {
                                message: 'El Rol ya esta asignado al Permiso',
                                type: 'POST',
                                url: 'http://192.168.0.3/SiCLabS2014/permisoRol/_comprobarPermisoRol/',
                                data: function (validator) {
                                    return {
                                        Select_Permiso: validator.getFieldElements('Select_Permiso').val()
                                    };
                                }
                            }
                        }
                    },
                    Select_Permiso: {
                        message: 'El Campo invalido.',
                        validators: {
                            notEmpty: {
                                message: 'Campo requerido.'
                            },
                            // Envia { Select_Rol, Select_Permiso'} al back-end
                            remote: {
                                message: 'El Permiso ya esta asignado al Rol',
                                type: 'POST',
                                url: 'http://192.168.0.3/SiCLabS2014/permisoRol/_comprobarPermisoRol/',
                                data: function (validator) {
                                    return {
                                        Select_Rol: validator.getFieldElements('Select_Rol').val()
                                    };
                                }
                            }
                        }

                    },
                    Select_Estado: {
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
    $('#Select_Permiso').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormPermisoRol').bootstrapValidator('revalidateField', 'Select_Rol');
    });

    $('#Select_Rol').on('change', function (e) {
        // Revalidar cuando cambia
        $('#FormPermisoRol').bootstrapValidator('revalidateField', 'Select_Permiso');
    });
});


