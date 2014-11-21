
var getUsuarios = function (tipo) {
    var ruta = '';
    var parametros = '';

    switch (tipo) {
        case 'btn_nombre':
            var nombre = $('#B_Nombre').val();
            var apellido = $('#B_Apellido').val();
            ruta = ROOT + 'usuario/_buscarFiltro/NombreCompleto/';
            var parametros = {B_Nombre: nombre, B_Apellido: apellido};
            break;

        case 'btn_matricula':
            var matricula = $('#B_Matricula').val();
            ruta = ROOT + 'usuario/_buscarFiltro/Matricula/';
            var parametros = {B_Matricula: matricula};
            break;

        case 'btn_rol':
            var rol = $('#B_Rol').val();
            ruta = ROOT + 'usuario/_buscarFiltro/Rol/';
            var parametros = {B_Rol: rol};
            break;
    }


    $.post(ruta, parametros, function (datos) {
        $("#Select_Usuario").html('');
        if (datos.length > 0) {
            for (var i = 0; i < datos.length; i++) {
                $("#Select_Usuario").append('<option value="' + datos[i].Id + '">' + datos[i].Matricula + ' - ' + datos[i].Nombre + ' ' + datos[i].Apellido + '</option>');
            }
        } else {
            $("#Select_Usuario").append('<option value="">- Sin Coincidencias -</option>');
        }

    }, 'json');
}

$(".btn_buscar").click(function () {
    getUsuarios($(this).attr("id"));
});
