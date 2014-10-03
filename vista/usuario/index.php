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
        <?php foreach ($this->listaUsuarios as $key => $tipoEspacio): ?>
            <tr>
                <td><?php echo $tipoEspacio->getMatricula(); ?></td>
                <td><?php echo $tipoEspacio->getRol()->getNombre(); ?></td>
                <td><?php echo $tipoEspacio->getNombre(); ?></td>
                <td><?php echo $tipoEspacio->getApellido(); ?></td>
                <td><?php echo $tipoEspacio->getCorreo(); ?></td>
                <td><?php echo $tipoEspacio->getContrasena(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'usuario/editar/' . $tipoEspacio->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'usuario/mostrar/' . $tipoEspacio->getId(); ?>">Mostrar</a> | 
                    <a href="<?php echo ROOT . 'usuario/eliminar/' . $tipoEspacio->getId(); ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($this->paginacion)) echo $this->paginacion; ?>
<p>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>
