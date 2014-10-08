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
        <?php foreach ($this->listaUsuarios as $key => $permisoRol): ?>
            <tr>
                <td><?php echo $permisoRol->getMatricula(); ?></td>
                <td><?php echo $permisoRol->getRol()->getNombre(); ?></td>
                <td><?php echo $permisoRol->getNombre(); ?></td>
                <td><?php echo $permisoRol->getApellido(); ?></td>
                <td><?php echo $permisoRol->getCorreo(); ?></td>
                <td><?php echo $permisoRol->getContrasena(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'usuario/editar/' . $permisoRol->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'usuario/mostrar/' . $permisoRol->getId(); ?>">Mostrar</a> | 
                    <a href="<?php echo ROOT . 'usuario/eliminar/' . $permisoRol->getId(); ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($this->paginacion)) echo $this->paginacion; ?>
<p>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>
