<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'usuario/nuevo'; ?>" class="btn btn-link">Nuevo Usuario</a>
</p>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Matricula</th>
            <th>Rol</th>
            <th>Nombre(s)</th>
            <th>Apellido(s)</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Fotografía</th>
            <th>Opciones</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($this->listaUsuarios as $key => $rol): ?>
            <tr>
                <td><?php echo $rol->getMatricula(); ?></td>
                <td><?php echo $rol->getRol()->getNombre(); ?></td>
                <td><?php echo $rol->getNombre(); ?></td>
                <td><?php echo $rol->getApellido(); ?></td>
                <td><?php echo $rol->getCorreo(); ?></td>
                <td><?php echo $rol->getContrasena(); ?></td>
                <td><?php echo $rol->getFotografia(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'usuario/editar/' . $rol->getMatricula(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'usuario/mostrar/' . $rol->getMatricula(); ?>">Mostrar</a> | 
                    <a href="<?php echo ROOT . 'usuario/eliminar/' . $rol->getMatricula(); ?>">Eliminar</a>
                    
                   
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
  <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>
