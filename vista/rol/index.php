<h1>Lista de Roles</h1>
<a href="<?php echo ROOT . 'rol/nuevo'; ?>" class="btn btn-link">Nuevo Rol</a>


<table class="table table-hover">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del Rol</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->listaRoles as $key => $rol): ?>
            <tr>
                <td><?php echo $rol->getId(); ?></td>
                <td><?php echo $rol->getNombre(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'rol/editar/' . $rol->getId(); ?>">Editar</a>
                    <a href="<?php echo ROOT . 'rol/mostrar/' . $rol->getId(); ?>" >Mostrar</a>
                    <a href="<?php echo ROOT . 'rol/eliminar/' . $rol->getId(); ?>" >Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>