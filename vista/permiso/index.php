<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'permiso/nuevo'; ?>" class="btn btn-link">Nuevo Permiso</a>
</p>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre del Permiso</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($this->listaPermisos as $key => $permisoRol): ?>
            <tr>
                <td><?php echo $permisoRol->getNombre(); ?></td>
                <td><?php echo $permisoRol->getDescripcion(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'permiso/editar/' . $permisoRol->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'permiso/mostrar/' . $permisoRol->getId(); ?>" >Mostrar</a> | 
                    <a href="<?php echo ROOT . 'permiso/eliminar/' . $permisoRol->getId(); ?>" >Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>