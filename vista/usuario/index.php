<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'usuario/nuevo'; ?>" class="btn btn-link">Nuevo Usuario</a>
</p>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Matricula</th>
            <th>Rol</th>
            <th>Nombre(s)</th>
            <th>Apellido(s)</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Opciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->listaUsuarios as $key => $usuario): ?>
            <tr>
                <td><?php echo $usuario->getMatricula(); ?></td>
                <td><?php echo $usuario->getRol()->getNombre(); ?></td>
                <td><?php echo $usuario->getNombre(); ?></td>
                <td><?php echo $usuario->getApellido(); ?></td>
                <td><?php echo $usuario->getCorreo(); ?></td>
                <td><?php echo $usuario->getContrasena(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'usuario/editar/' . $usuario->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'usuario/mostrar/' . $usuario->getId(); ?>">Mostrar</a> | 
                    <a href="<?php echo ROOT . 'usuario/eliminar/' . $usuario->getId(); ?>">Eliminar</a>
                    
                    
                    <div class="btn-group btn-group-sm ">
                        <a href="<?php echo ROOT . 'usuario/editar/' . $usuario->getId(); ?>" class="btn btn-default"><i class="glyphicon glyphicon-edit"></i></a> 
                        <a href="<?php echo ROOT . 'usuario/mostrar/' . $usuario->getId(); ?>"class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="javascript:;" class="btn btn-danger"
                           data-title="<div class='text-center text-danger'><b>¿Eliminar?</b></div>"
                           data-toggle="popover"
                           data-content="
                           <div class='text-center'>
                           <div class='btn-group btn-group-sm'>
                           <a class='btn btn-default' data-dismiss='popover' aria-hidden='true'><i class='glyphicon glyphicon-remove'></i></a>
                           <a href='<?php echo ROOT . "usuario/eliminar/" . $usuario->getId(); ?>' 
                           class='btn btn-danger'><i class='glyphicon glyphicon-ok'></i></a>
                           </div>
                           </div>">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($this->paginacion)) echo $this->paginacion; ?>
<p>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>
