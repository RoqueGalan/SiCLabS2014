<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'permisoRol/nuevo'; ?>" class="btn btn-link">Asignar Permiso a Rol</a>
</p>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre del Rol</th>
            <th>Nombre del Permiso</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->listaPermisosRol as $key => $permisoRol): ?>
            <tr>
                <td><?php echo $permisoRol->getRol()->getNombre(); ?></td>
                <td><?php echo $permisoRol->getPermiso()->getNombre(); ?></td>
                <td><?php echo $permisoRol->getEstado(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'permisoRol/editar/' . $permisoRol->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'permisoRol/mostrar/' . $permisoRol->getId(); ?>" >Mostrar</a> | 
                    <a href="<?php echo ROOT . 'permisoRol/eliminar/' . $permisoRol->getId(); ?>" >Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>