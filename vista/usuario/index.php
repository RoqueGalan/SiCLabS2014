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
        <?php foreach ($this->listaUsuarios as $key => $permiso): ?>
            <tr>
                <td><?php echo $permiso->getMatricula(); ?></td>
                <td><?php echo $permiso->getRol()->getNombre(); ?></td>
                <td><?php echo $permiso->getNombre(); ?></td>
                <td><?php echo $permiso->getApellido(); ?></td>
                <td><?php echo $permiso->getCorreo(); ?></td>
                <td><?php echo $permiso->getContrasena(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'usuario/editar/' . $permiso->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'usuario/mostrar/' . $permiso->getId(); ?>">Mostrar</a> | 
                    <a href="<?php echo ROOT . 'usuario/eliminar/' . $permiso->getId(); ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($this->paginacion)) echo $this->paginacion; ?>
<p>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>
